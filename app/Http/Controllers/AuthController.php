<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Xử lý đăng xuất
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Đã đăng xuất thành công.');
    }
}
