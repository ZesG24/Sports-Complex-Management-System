<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class San extends Model
{
    use HasFactory;

    protected $table = 'san';

    protected $primaryKey = 'MaSan';

    protected $fillable = [
        'TenSan',
        'GiaThue',
        'TinhTrang',
        'MoTa',
        'HinhAnh',
        'MaLoai',
    ];

    protected function casts(): array
    {
        return [
            'GiaThue' => 'decimal:2',
        ];
    }

    public function loaiSan(): BelongsTo
    {
        return $this->belongsTo(LoaiSan::class, 'MaLoai', 'MaLoai');
    }

    public function chiTietPhieuDatSan(): HasMany
    {
        return $this->hasMany(ChiTietPhieuDatSan::class, 'MaSan', 'MaSan');
    }
}
