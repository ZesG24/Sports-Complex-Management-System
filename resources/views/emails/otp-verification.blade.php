<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã xác thực OTP</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f7f9f4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #17231f;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f7f9f4; padding: 40px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 520px; background-color: #ffffff; border-radius: 18px; overflow: hidden; box-shadow: 0 10px 30px rgba(23,35,31,0.06); border: 1px solid #e4eae5;">
                    <!-- Header -->
                    <tr>
                        <td style="padding: 32px 36px 20px; text-align: center; background-color: #ffffff;">
                            <div style="display: inline-block; width: 44px; height: 44px; line-height: 44px; border-radius: 12px; background-color: #d8f46e; font-size: 22px; color: #1c3025; font-weight: 800; text-align: center;">⚡</div>
                            <h1 style="margin: 12px 0 0; font-size: 20px; font-weight: 800; color: #17231f; letter-spacing: -0.03em;">Sports Complex</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 10px 36px 36px;">
                            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.6; color: #17231f;">
                                Xin chào <strong>{{ $hoTen }}</strong>,
                            </p>
                            <p style="margin: 0 0 24px; font-size: 14px; line-height: 1.6; color: #71807a;">
                                Bạn vừa thực hiện yêu cầu đăng ký tài khoản tại <strong>Sports Complex</strong>. Vui lòng sử dụng mã xác thực OTP dưới đây để hoàn tất quá trình đăng ký:
                            </p>

                            <!-- OTP Box -->
                            <div style="text-align: center; margin: 30px 0; padding: 22px; background-color: #f7f9f4; border: 2px dashed #158f68; border-radius: 14px;">
                                <span style="font-size: 12px; font-weight: 700; color: #158f68; text-transform: uppercase; letter-spacing: 0.12em; display: block; margin-bottom: 8px;">Mã xác thực của bạn</span>
                                <span style="font-size: 34px; font-weight: 800; letter-spacing: 8px; color: #158f68; font-family: 'Courier New', Courier, monospace; display: inline-block; padding-left: 8px;">{{ $otp }}</span>
                            </div>

                            <p style="margin: 0 0 8px; font-size: 13px; color: #71807a; line-height: 1.5;">
                                ⏱️ Mã OTP này có hiệu lực trong vòng <strong>10 phút</strong>.
                            </p>
                            <p style="margin: 0; font-size: 13px; color: #71807a; line-height: 1.5;">
                                🔒 Vì lý do bảo mật, vui lòng không chia sẻ mã này cho bất kỳ ai. Nếu không phải bạn thực hiện yêu cầu này, hãy bỏ qua email này.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 36px; background-color: #f7f9f4; border-top: 1px solid #e4eae5; text-align: center;">
                            <p style="margin: 0; font-size: 12px; color: #71807a;">
                                © {{ date('Y') }} Sports Complex. Hệ sinh thái thể thao đa năng hiện đại.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

