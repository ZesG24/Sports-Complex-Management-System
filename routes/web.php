<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dat-san', function () {
    return view('booking');
})->name('booking');

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

    return view('store', compact('categories', 'products'));
})->name('store');
