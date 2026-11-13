<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTietPhieuDatSan extends Model
{
    use HasFactory;

    protected $table = 'chitietphieudatsan_san';

    protected $fillable = [
        'MaDatSan',
        'MaSan',
        'GioBatDau',
        'GioKetThuc',
        'DonGia',
    ];

    protected function casts(): array
    {
        return [
            'DonGia' => 'decimal:2',
        ];
    }

    public function phieuDatSan(): BelongsTo
    {
        return $this->belongsTo(PhieuDatSan::class, 'MaDatSan', 'MaDatSan');
    }

    public function san(): BelongsTo
    {
        return $this->belongsTo(San::class, 'MaSan', 'MaSan');
    }
}
