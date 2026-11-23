<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PhuKienThue extends Model
{
    use HasFactory;

    protected $table = 'phukienthue';

    protected $primaryKey = 'MaPKThue';

    protected $fillable = [
        'TenPhuKien',
        'PhanLoai',
        'KichThuoc',
        'GiaThue',
        'TienCoc',
        'TongSoLuong',
        'SoLuongKhaDung',
        'HinhAnh',
        'MoTa',
        'TinhTrang',
    ];

    protected function casts(): array
    {
        return [
            'GiaThue' => 'decimal:2',
            'TienCoc' => 'decimal:2',
            'TongSoLuong' => 'integer',
            'SoLuongKhaDung' => 'integer',
        ];
    }

    public function phieuThue(): BelongsToMany
    {
        return $this->belongsToMany(PhieuThue::class, 'chitietphieuthue', 'MaPKThue', 'MaPhieuThue')
            ->withPivot(['SoLuong', 'DonGiaThue', 'TienCoc']);
    }
}
