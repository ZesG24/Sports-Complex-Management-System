<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KhachHang extends Model
{
    use HasFactory;

    protected $table = 'khachhang';

    protected $primaryKey = 'MaKH';

    protected $fillable = [
        'HoTen',
        'SDT',
        'Email',
        'DiaChi',
        'MaTK',
        'MaHang',
        'DiemTichLuy',
        'TongChiTieu',
        'NgayHetHanVIP',
    ];

    protected function casts(): array
    {
        return [
            'DiemTichLuy' => 'integer',
            'TongChiTieu' => 'decimal:2',
            'NgayHetHanVIP' => 'datetime',
        ];
    }

    public function taiKhoan(): BelongsTo
    {
        return $this->belongsTo(TaiKhoan::class, 'MaTK', 'MaTK');
    }

    public function hangThanhVien(): BelongsTo
    {
        return $this->belongsTo(HangThanhVien::class, 'MaHang', 'MaHang');
    }

    public function baiDangTimBan(): HasMany
    {
        return $this->hasMany(BaiDangTimBan::class, 'MaKH', 'MaKH');
    }

    public function thamGiaTimBan(): HasMany
    {
        return $this->hasMany(ThamGiaTimBan::class, 'MaKH', 'MaKH');
    }

    public function phieuDatSan(): HasMany
    {
        return $this->hasMany(PhieuDatSan::class, 'MaKH', 'MaKH');
    }

    public function phieuThue(): HasMany
    {
        return $this->hasMany(PhieuThue::class, 'MaKH', 'MaKH');
    }
}
