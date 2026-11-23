<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HoaDon extends Model
{
    use HasFactory;

    protected $table = 'hoadon';

    protected $primaryKey = 'MaHD';

    protected $fillable = [
        'MaDatSan',
        'NgayLap',
        'TongTien',
        'GhiChu',
        'TenPhuongThuc',
        'TrangThai',
        'MaGiaoDich',
        'MaBaoCao',
    ];

    protected function casts(): array
    {
        return [
            'NgayLap' => 'date',
            'TongTien' => 'decimal:2',
        ];
    }

    public function phieuDatSan(): BelongsTo
    {
        return $this->belongsTo(PhieuDatSan::class, 'MaDatSan', 'MaDatSan');
    }
}
