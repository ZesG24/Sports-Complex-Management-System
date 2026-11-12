<?php

namespace App\Http\Controllers;

use App\Mail\OtpVerificationMail;
use App\Models\KhachHang;
use App\Models\TaiKhoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Hiển thị trang đăng nhập
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Xử lý yêu cầu đăng nhập
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'TenDangNhap' => ['required', 'string'],
            'MatKhau' => ['required', 'string'],
        ], [
            'TenDangNhap.required' => 'Vui lòng nhập tên đăng nhập.',
            'MatKhau.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $attemptCredentials = [
            'TenDangNhap' => $credentials['TenDangNhap'],
            'password' => $credentials['MatKhau'],
        ];

        if (Auth::attempt($attemptCredentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            /** @var TaiKhoan $user */
            $user = Auth::user();

            if ($user->isOwner()) {
                return redirect()->intended(route('home'))->with('success', 'Chào mừng Chủ sân!');
            }

            if ($user->isAdmin()) {
                return redirect()->intended(route('home'))->with('success', 'Chào mừng Quản trị viên (POS)!');
            }

            return redirect()->intended(route('home'))->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'TenDangNhap' => 'Tên đăng nhập hoặc mật khẩu không chính xác.',
        ])->onlyInput('TenDangNhap');
    }

    /**
     * Hiển thị trang đăng ký khách hàng
     */
    public function showRegisterForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    /**
     * Xử lý bước 1 đăng ký: Validate và gửi OTP qua Email
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'HoTen' => ['required', 'string', 'max:255'],
            'SDT' => ['required', 'string', 'regex:/^(0[3|5|7|8|9])[0-9]{8}$/'],
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:khachhang,Email'],
            'TenDangNhap' => ['required', 'string', 'min:4', 'max:50', 'alpha_dash', 'unique:taikhoan,TenDangNhap'],
            'MatKhau' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'HoTen.required' => 'Vui lòng nhập họ và tên.',
            'SDT.required' => 'Vui lòng nhập số điện thoại.',
            'SDT.regex' => 'Số điện thoại không hợp lệ (ví dụ: 0912345678).',
            'Email.required' => 'Vui lòng nhập email.',
            'Email.email' => 'Địa chỉ email không đúng định dạng.',
            'Email.unique' => 'Email này đã được sử dụng bởi tài khoản khác.',
            'TenDangNhap.required' => 'Vui lòng nhập tên đăng nhập.',
            'TenDangNhap.min' => 'Tên đăng nhập phải có ít nhất 4 ký tự.',
            'TenDangNhap.max' => 'Tên đăng nhập không được vượt quá 50 ký tự.',
            'TenDangNhap.alpha_dash' => 'Tên đăng nhập chỉ được chứa chữ cái, số, dấu gạch nối và gạch dưới.',
            'TenDangNhap.unique' => 'Tên đăng nhập này đã tồn tại, vui lòng chọn tên khác.',
            'MatKhau.required' => 'Vui lòng nhập mật khẩu.',
            'MatKhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'MatKhau.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        // Tạo mã OTP ngẫu nhiên 6 chữ số
        $otp = (string) random_int(100000, 999999);

        // Lưu thông tin đăng ký tạm thời vào session (hạn 10 phút)
        session([
            'register_pending' => [
                'data' => [
                    'HoTen' => $validated['HoTen'],
                    'SDT' => $validated['SDT'],
                    'Email' => $validated['Email'],
                    'TenDangNhap' => $validated['TenDangNhap'],
                    'MatKhau' => Hash::make($validated['MatKhau']),
                ],
                'otp' => $otp,
                'expires_at' => now()->addMinutes(10)->timestamp,
                'attempts' => 0,
                'last_sent_at' => now()->timestamp,
            ],
        ]);

        // Gửi email chứa mã OTP
        try {
            Mail::to($validated['Email'])->send(new OtpVerificationMail($otp, $validated['HoTen']));
        } catch (\Throwable $e) {
            Log::error('Lỗi gửi email xác thực OTP: ' . $e->getMessage());
        }

        $response = redirect()->route('register.verify-otp')->with(
            'success',
            'Mã xác thực OTP đã được gửi đến email ' . $validated['Email'] . '. Vui lòng kiểm tra hộp thư!'
        );

        return $response;
    }

    /**
     * Hiển thị trang nhập mã OTP
     */
    public function showVerifyOtpForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $pending = session('register_pending');

        if (! $pending) {
            return redirect()->route('register')->withErrors([
                'general' => 'Không tìm thấy phiên đăng ký hoặc phiên đã hết hạn. Vui lòng đăng ký lại.',
            ]);
        }

        if (now()->timestamp > $pending['expires_at']) {
            session()->forget('register_pending');

            return redirect()->route('register')->withErrors([
                'general' => 'Mã OTP đã hết hiệu lực (quá 10 phút). Vui lòng đăng ký lại.',
            ]);
        }

        $email = $pending['data']['Email'];
        $maskedEmail = $this->maskEmail($email);
        $secondsRemaining = max(0, 60 - (now()->timestamp - $pending['last_sent_at']));

        return view('auth.verify-otp', [
            'email' => $email,
            'maskedEmail' => $maskedEmail,
            'secondsRemaining' => $secondsRemaining,
        ]);
    }

    /**
     * Xử lý xác thực OTP và khởi tạo tài khoản khách hàng
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $pending = session('register_pending');

        if (! $pending) {
            return redirect()->route('register')->withErrors([
                'general' => 'Phiên đăng ký đã hết hạn. Vui lòng thử lại.',
            ]);
        }

        if (now()->timestamp > $pending['expires_at']) {
            session()->forget('register_pending');

            return redirect()->route('register')->withErrors([
                'general' => 'Mã OTP đã hết thời hạn 10 phút. Vui lòng đăng ký lại.',
            ]);
        }

        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ], [
            'otp.required' => 'Vui lòng nhập đủ 6 chữ số mã OTP.',
            'otp.size' => 'Mã OTP phải bao gồm đúng 6 chữ số.',
        ]);

        $inputOtp = trim($request->input('otp'));

        // Kiểm tra số lần nhập sai
        if ($pending['attempts'] >= 5) {
            session()->forget('register_pending');

            return redirect()->route('register')->withErrors([
                'general' => 'Bạn đã nhập sai mã OTP quá 5 lần. Vì lý do bảo mật, vui lòng đăng ký lại từ đầu.',
            ]);
        }

        // Kiểm tra khớp OTP
        if ($inputOtp !== $pending['otp']) {
            $pending['attempts']++;
            session(['register_pending' => $pending]);

            $remainingAttempts = 5 - $pending['attempts'];

            return back()->withErrors([
                'otp' => "Mã OTP không chính xác. Bạn còn {$remainingAttempts} lần thử.",
            ]);
        }

        // Tạo tài khoản và hồ sơ khách hàng trong Transaction
        DB::beginTransaction();

        try {
            $taiKhoan = TaiKhoan::create([
                'TenDangNhap' => $pending['data']['TenDangNhap'],
                'MatKhau' => $pending['data']['MatKhau'],
                'LoaiTK' => 'user',
            ]);

            KhachHang::create([
                'HoTen' => $pending['data']['HoTen'],
                'SDT' => $pending['data']['SDT'],
                'Email' => $pending['data']['Email'],
                'MaTK' => $taiKhoan->MaTK,
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Lỗi tạo tài khoản sau OTP: ' . $e->getMessage());

            return back()->withErrors([
                'otp' => 'Đã có lỗi kỹ thuật xảy ra trong quá trình tạo tài khoản. Vui lòng thử lại.',
            ]);
        }

        // Xóa session đăng ký tạm
        session()->forget('register_pending');

        // Tự động đăng nhập
        Auth::login($taiKhoan);
        $request->session()->regenerate();

        return redirect()->route('home')->with(
            'success',
            'Đăng ký tài khoản thành công! Chào mừng ' . $pending['data']['HoTen'] . ' đến với Sports Complex.'
        );
    }

    /**
     * Gửi lại mã OTP
     */
    public function resendOtp(): RedirectResponse
    {
        $pending = session('register_pending');

        if (! $pending) {
            return redirect()->route('register')->withErrors([
                'general' => 'Phiên đăng ký đã hết hạn. Vui lòng đăng ký lại.',
            ]);
        }

        // Kiểm tra cooldown 60 giây
        $elapsed = now()->timestamp - $pending['last_sent_at'];
        if ($elapsed < 60) {
            $wait = 60 - $elapsed;

            return back()->withErrors([
                'otp' => "Vui lòng đợi thêm {$wait} giây trước khi yêu cầu gửi lại mã mới.",
            ]);
        }

        // Sinh mã mới
        $newOtp = (string) random_int(100000, 999999);
        $pending['otp'] = $newOtp;
        $pending['expires_at'] = now()->addMinutes(10)->timestamp;
        $pending['last_sent_at'] = now()->timestamp;
        $pending['attempts'] = 0;

        session(['register_pending' => $pending]);

        try {
            Mail::to($pending['data']['Email'])->send(new OtpVerificationMail($newOtp, $pending['data']['HoTen']));
        } catch (\Throwable $e) {
            Log::error('Lỗi gửi lại mã OTP: ' . $e->getMessage());
        }

        $response = back()->with('success', 'Mã OTP mới đã được gửi tới email của bạn!');

        return $response;
    }

    /**
     * Xử lý đăng xuất
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Đã đăng xuất thành công.');
    }

    /**
     * Ẩn một phần email để bảo vệ thông tin riêng tư (VD: ng***@gmail.com)
     */
    private function maskEmail(string $email): string
    {
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return $email;
        }

        $name = $parts[0];
        $domain = $parts[1];

        if (strlen($name) <= 2) {
            $maskedName = substr($name, 0, 1) . '*';
        } else {
            $maskedName = substr($name, 0, 2) . str_repeat('*', max(1, strlen($name) - 3)) . substr($name, -1);
        }

        return $maskedName . '@' . $domain;
    }
}
