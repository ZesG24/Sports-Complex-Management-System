<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PhieuDatSan extends Model
{
    use HasFactory;

    protected $table = 'phieudatsan';

    protected $primaryKey = 'MaDatSan';

    protected $fillable = [
        'MaKH',
        'NgayDat',
        'TongTien',
        'TrangThai',
        'GhiChu',
    ];

    protected function casts(): array
    {
        return [
            'NgayDat' => 'date',
            'TongTien' => 'decimal:2',
        ];
    }

    public function khachHang(): BelongsTo
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }

    public function chiTiet(): HasMany
    {
        return $this->hasMany(ChiTietPhieuDatSan::class, 'MaDatSan', 'MaDatSan');
    }

    public function hoaDon(): HasOne
    {
        return $this->hasOne(HoaDon::class, 'MaDatSan', 'MaDatSan');
    }

    public function phieuThue(): HasMany
    {
        return $this->hasMany(PhieuThue::class, 'MaDatSan', 'MaDatSan');
    }
}
