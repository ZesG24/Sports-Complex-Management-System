<?php

namespace App\Services;

use App\Models\HoaDon;
use App\Models\PhieuDatSan;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZaloPayService
{
    /**
     * Khởi tạo HTTP client cho ZaloPay và xử lý lỗi đường dẫn cacert.pem của Laragon trên máy local.
     */
    private function httpClient(): PendingRequest
    {
        $client = Http::connectTimeout(5)
            ->timeout(15)
            ->asForm();

        $verifySsl = config('services.zalopay.verify_ssl', true);
        if ($verifySsl === false || $verifySsl === 'false' || $verifySsl === 0 || $verifySsl === '0') {
            return $client->withoutVerifying();
        }

        $cainfo = (string) ini_get('curl.cainfo');
        if ($cainfo !== '' && ! is_file($cainfo)) {
            $laragonCert = 'C:\\laragon\\etc\\ssl\\cacert.pem';
            if (is_file($laragonCert)) {
                return $client->withOptions(['verify' => $laragonCert]);
            }

            if (app()->isLocal()) {
                return $client->withoutVerifying();
            }
        }

        return $client;
    }

    /**
     * Tạo đơn hàng thanh toán trên ZaloPay Gateway v2.
     *
     * @return array{
     *     success: bool,
     *     app_trans_id: string,
     *     order_url: ?string,
     *     zp_trans_token: ?string,
     *     return_code: int,
     *     return_message: string,
     *     sub_return_message: ?string
     * }
     */
    public function createOrder(PhieuDatSan $phieuDatSan, HoaDon $hoaDon, string $redirectUrl): array
    {
        $appId = (int) config('services.zalopay.app_id');
        $key1 = (string) config('services.zalopay.key1');
        $createUrl = (string) config('services.zalopay.create_url');
        $callbackUrl = config('services.zalopay.callback_url');

        $phieuDatSan->loadMissing('chiTiet.san');

        $appTime = (int) round(microtime(true) * 1000);
        $appTransId = now('Asia/Ho_Chi_Minh')->format('ymd').'_'.$hoaDon->MaHD.'_'.random_int(100000, 999999);
        $appUser = 'kh_'.$phieuDatSan->MaKH;
        $amount = (int) round((float) $hoaDon->TongTien);

        $items = $phieuDatSan->chiTiet->map(function ($detail) {
            return [
                'itemid' => (string) $detail->MaSan,
                'itemname' => $detail->san?->TenSan ?? ('Sân #'.$detail->MaSan),
                'itemprice' => (int) round((float) $detail->DonGia),
                'itemquantity' => 1,
            ];
        })->values()->all();

        $embedData = json_encode([
            'redirecturl' => $redirectUrl,
            'booking_id' => $phieuDatSan->MaDatSan,
            'invoice_id' => $hoaDon->MaHD,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $itemJson = json_encode($items, JSON_UNESCAPED_UNICODE);
        $description = 'Thanh toan dat san #MDS-'.$phieuDatSan->MaDatSan.' - The thao Anh Vinh';

        $hmacInput = implode('|', [
            $appId,
            $appTransId,
            $appUser,
            $amount,
            $appTime,
            $embedData,
            $itemJson,
        ]);

        $payload = [
            'app_id' => $appId,
            'app_user' => $appUser,
            'app_time' => $appTime,
            'amount' => $amount,
            'app_trans_id' => $appTransId,
            'embed_data' => $embedData,
            'item' => $itemJson,
            'description' => $description,
            'bank_code' => '',
            'mac' => hash_hmac('sha256', $hmacInput, $key1),
        ];

        if (is_string($callbackUrl) && trim($callbackUrl) !== '') {
            $payload['callback_url'] = trim($callbackUrl);
        }

        try {
            $response = $this->httpClient()->post($createUrl, $payload);

            $data = $response->json();
            if (! is_array($data)) {
                Log::error('ZaloPay createOrder invalid response', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [
                    'success' => false,
                    'app_trans_id' => $appTransId,
                    'order_url' => null,
                    'zp_trans_token' => null,
                    'return_code' => -1,
                    'return_message' => 'Phản hồi từ ZaloPay không hợp lệ.',
                    'sub_return_message' => null,
                ];
            }

            $returnCode = (int) ($data['return_code'] ?? -1);

            return [
                'success' => $returnCode === 1 && ! empty($data['order_url']),
                'app_trans_id' => $appTransId,
                'order_url' => $data['order_url'] ?? null,
                'zp_trans_token' => $data['zp_trans_token'] ?? null,
                'return_code' => $returnCode,
                'return_message' => (string) ($data['return_message'] ?? 'Không thể tạo giao dịch ZaloPay.'),
                'sub_return_message' => isset($data['sub_return_message']) ? (string) $data['sub_return_message'] : null,
            ];
        } catch (ConnectionException $e) {
            Log::error('ZaloPay createOrder connection error: '.$e->getMessage());

            return [
                'success' => false,
                'app_trans_id' => $appTransId,
                'order_url' => null,
                'zp_trans_token' => null,
                'return_code' => -1,
                'return_message' => 'Không thể kết nối đến cổng thanh toán ZaloPay.',
                'sub_return_message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Truy vấn trạng thái giao dịch từ ZaloPay Gateway v2.
     *
     * @return array{
     *     return_code: int,
     *     return_message: string,
     *     sub_return_code: ?int,
     *     sub_return_message: ?string,
     *     is_processing: bool,
     *     amount: int,
     *     zp_trans_id: ?string
     * }
     */
    public function queryOrder(string $appTransId): array
    {
        $appId = (int) config('services.zalopay.app_id');
        $key1 = (string) config('services.zalopay.key1');
        $queryUrl = (string) config('services.zalopay.query_url');

        $mac = hash_hmac('sha256', "{$appId}|{$appTransId}|{$key1}", $key1);

        try {
            $response = $this->httpClient()->post($queryUrl, [
                'app_id' => $appId,
                'app_trans_id' => $appTransId,
                'mac' => $mac,
            ]);

            $data = $response->json();
            if (! is_array($data)) {
                return [
                    'return_code' => -1,
                    'return_message' => 'Phản hồi truy vấn ZaloPay không hợp lệ.',
                    'sub_return_code' => null,
                    'sub_return_message' => null,
                    'is_processing' => false,
                    'amount' => 0,
                    'zp_trans_id' => null,
                ];
            }

            return [
                'return_code' => (int) ($data['return_code'] ?? -1),
                'return_message' => (string) ($data['return_message'] ?? ''),
                'sub_return_code' => isset($data['sub_return_code']) ? (int) $data['sub_return_code'] : null,
                'sub_return_message' => isset($data['sub_return_message']) ? (string) $data['sub_return_message'] : null,
                'is_processing' => (bool) ($data['is_processing'] ?? false),
                'amount' => (int) ($data['amount'] ?? 0),
                'zp_trans_id' => isset($data['zp_trans_id']) ? (string) $data['zp_trans_id'] : null,
            ];
        } catch (ConnectionException $e) {
            Log::error('ZaloPay queryOrder connection error: '.$e->getMessage());

            return [
                'return_code' => -1,
                'return_message' => 'Không thể kết nối ZaloPay để kiểm tra trạng thái giao dịch.',
                'sub_return_code' => null,
                'sub_return_message' => $e->getMessage(),
                'is_processing' => false,
                'amount' => 0,
                'zp_trans_id' => null,
            ];
        }
    }

    /**
     * Xác thực chữ ký MAC của Callback từ ZaloPay Server bằng key2.
     */
    public function verifyCallback(string $dataStr, string $requestMac): bool
    {
        $key2 = (string) config('services.zalopay.key2');

        if ($key2 === '' || $requestMac === '') {
            return false;
        }

        $expectedMac = hash_hmac('sha256', $dataStr, $key2);

        return hash_equals($expectedMac, $requestMac);
    }
}
