<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PhieuThue extends Model
{
    use HasFactory;

    protected $table = 'phieuthue';

    protected $primaryKey = 'MaPhieuThue';

    protected $fillable = [
        'MaKH',
        'MaDatSan',
        'TenKhachThue',
        'SDTKhachThue',
        'NgayThue',
        'ThoiGianMuon',
        'ThoiGianTra',
        'TongTienThue',
        'TrangThai',
        'GhiChu',
    ];

    protected function casts(): array
    {
        return [
            'NgayThue' => 'date',
            'ThoiGianMuon' => 'datetime',
            'ThoiGianTra' => 'datetime',
            'TongTienThue' => 'decimal:2',
        ];
    }

    public function khachHang(): BelongsTo
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }

    public function phieuDatSan(): BelongsTo
    {
        return $this->belongsTo(PhieuDatSan::class, 'MaDatSan', 'MaDatSan');
    }

    public function phuKienThue(): BelongsToMany
    {
        return $this->belongsToMany(PhuKienThue::class, 'chitietphieuthue', 'MaPhieuThue', 'MaPKThue')
            ->withPivot(['SoLuong', 'DonGiaThue', 'GhiChu']);
    }
}
