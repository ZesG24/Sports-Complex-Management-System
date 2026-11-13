<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaiDangTimBan extends Model
{
    use HasFactory;

    protected $table = 'baidangtimban';

    protected $primaryKey = 'MaBaiDang';

    protected $fillable = [
        'MaKH',
        'MaChiTietDatSan',
        'MaLoaiSan',
        'TieuDe',
        'NoiDung',
        'TrinhDo',
        'SoLuongCanTim',
        'SoLuongHienTai',
        'ThoiGianChoi',
        'ChiPhiUocTinh',
        'TrangThai',
    ];

    protected function casts(): array
    {
        return [
            'ThoiGianChoi' => 'datetime',
            'ChiPhiUocTinh' => 'decimal:2',
            'SoLuongCanTim' => 'integer',
            'SoLuongHienTai' => 'integer',
        ];
    }

    public function nguoiDang(): BelongsTo
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }

    public function loaiSan(): BelongsTo
    {
        return $this->belongsTo(LoaiSan::class, 'MaLoaiSan', 'MaLoai');
    }

    public function thamGia(): HasMany
    {
        return $this->hasMany(ThamGiaTimBan::class, 'MaBaiDang', 'MaBaiDang');
    }
}
