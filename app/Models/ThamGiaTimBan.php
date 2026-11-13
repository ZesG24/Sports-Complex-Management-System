<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThamGiaTimBan extends Model
{
    use HasFactory;

    protected $table = 'thamgia_timban';

    protected $primaryKey = 'MaThamGia';

    protected $fillable = [
        'MaBaiDang',
        'MaKH',
        'TrangThai',
        'LoiNhan',
        'NgayDangKy',
    ];

    protected function casts(): array
    {
        return [
            'NgayDangKy' => 'datetime',
        ];
    }

    public function baiDang(): BelongsTo
    {
        return $this->belongsTo(BaiDangTimBan::class, 'MaBaiDang', 'MaBaiDang');
    }

    public function khachHang(): BelongsTo
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }
}
