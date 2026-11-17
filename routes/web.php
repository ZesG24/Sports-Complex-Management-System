<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/register/verify-otp', [AuthController::class, 'showVerifyOtpForm'])->name('register.verify-otp');
    Route::post('/register/verify-otp', [AuthController::class, 'verifyOtp'])->name('register.verify-otp.submit');
    Route::post('/register/resend-otp', [AuthController::class, 'resendOtp'])->name('register.resend-otp');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/ho-so', [DashboardController::class, 'index'])->name('profile')->middleware('auth');

Route::get('/dat-san', [BookingController::class, 'index'])->name('booking');
Route::get('/dat-san/booked-slots', [BookingController::class, 'getBookedSlots'])->name('booking.slots');
Route::post('/dat-san/giu-cho', [BookingController::class, 'holdSlot'])->name('booking.hold');
Route::post('/dat-san/nha-cho', [BookingController::class, 'releaseSlot'])->name('booking.release');
Route::post('/dat-san', [BookingController::class, 'store'])->name('booking.store');

Route::get('/cua-hang', function () {
    $categories = [
        ['slug' => 'all', 'label' => 'Tất cả sản phẩm', 'icon' => '✦'],
        ['slug' => 'shoes', 'label' => 'Giày thể thao', 'icon' => '◒'],
        ['slug' => 'clothing', 'label' => 'Quần áo', 'icon' => '▱'],
        ['slug' => 'rental', 'label' => 'Thuê đồ', 'icon' => '↻'],
        ['slug' => 'accessories', 'label' => 'Phụ kiện', 'icon' => '●'],
        ['slug' => 'food-drink', 'label' => 'Đồ ăn & thức uống', 'icon' => '⌁'],
    ];

    $products = [
        ['name' => 'Giày Đá Bóng Firm Ground Predator Precision David Beckham', 'category' => 'shoes', 'category_label' => 'Giày thể thao', 'price' => '7.500.000đ', 'old_price' => '8.000.000đ', 'badge' => 'Bán chạy', 'icon' => '👟', 'tone' => 'mint'],
        ['name' => 'SNAKE LNR 3S T', 'category' => 'clothing', 'category_label' => 'Quần áo', 'price' => '750.000đ', 'old_price' => null, 'badge' => 'Mới', 'icon' => '👕', 'tone' => 'lime'],
        ['name' => 'Vợt cầu lông Li-Ning Turbo Charging 20D P-AYPT749-4', 'category' => 'rental', 'category_label' => 'Thuê đồ', 'price' => '80.000đ', 'old_price' => null, 'badge' => 'Thuê theo lượt', 'icon' => '🏸', 'tone' => 'sand'],
        ['name' => 'Bình nước giữ nhiệt 750ml', 'category' => 'accessories', 'category_label' => 'Phụ kiện', 'price' => '185.000đ', 'old_price' => null, 'badge' => null, 'icon' => '🥤', 'tone' => 'sky'],
        ['name' => 'Băng bảo vệ mắt cá chân trái/phải nâng đỡ mức 1', 'category' => 'accessories', 'category_label' => 'Phụ kiện', 'price' => '125.000đ', 'old_price' => null, 'badge' => null, 'icon' => '🧺', 'tone' => 'peach'],
        ['name' => 'Nước Bù Điện Giải Pocari Sweat (500ml)', 'category' => 'food-drink', 'category_label' => 'Đồ ăn & thức uống', 'price' => '15.000đ', 'old_price' => null, 'badge' => 'Nạp năng lượng', 'icon' => '🍋', 'tone' => 'yellow'],
    ];

    return view('store.index', compact('categories', 'products'));
})->name('store');
