<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'taikhoan';

    protected $primaryKey = 'MaTK';

    protected $fillable = [
        'TenDangNhap',
        'MatKhau',
        'LoaiTK',
    ];

    protected $hidden = [
        'MatKhau',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'MatKhau' => 'hashed',
        ];
    }

    /**
     * Tên cột chứa mật khẩu dùng cho Laravel Auth
     */
    public function getAuthPasswordName(): string
    {
        return 'MatKhau';
    }

    /**
     * Mối quan hệ 1-1 với thông tin khách hàng
     */
    public function khachHang(): HasOne
    {
        return $this->hasOne(KhachHang::class, 'MaTK', 'MaTK');
    }

    /**
     * Kiểm tra có phải chủ sân (Owner - toàn quyền) không
     */
    public function isOwner(): bool
    {
        return $this->LoaiTK === 'owner';
    }

    /**
     * Kiểm tra có phải quản trị viên / nhân viên POS (Admin) không
     */
    public function isAdmin(): bool
    {
        return $this->LoaiTK === 'admin';
    }

    /**
     * Kiểm tra có phải khách hàng (User thông thường) không
     */
    public function isUser(): bool
    {
        return $this->LoaiTK === 'user';
    }

    /**
     * Kiểm tra tài khoản có quyền quản trị (Owner hoặc Admin)
     */
    public function hasAdminAccess(): bool
    {
        return in_array($this->LoaiTK, ['owner', 'admin'], true);
    }

    /**
     * Lấy nhãn hiển thị loại tài khoản
     */
    public function getTenLoaiTKAttribute(): string
    {
        return match ($this->LoaiTK) {
            'owner' => 'Chủ sân',
            'admin' => 'Admin POS',
            'user' => 'Khách hàng',
            default => 'Người dùng',
        };
    }
}
