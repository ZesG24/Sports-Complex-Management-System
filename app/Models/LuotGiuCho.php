<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LuotGiuCho extends Model
{
    use HasFactory;

    protected $table = 'luotgiucho';

    protected $fillable = [
        'MaSan',
        'NgayDat',
        'GioBatDau',
        'GioKetThuc',
        'SessionId',
        'MaKH',
        'HetHanLuc',
    ];

    protected function casts(): array
    {
        return [
            'HetHanLuc' => 'datetime',
        ];
    }

    public function san(): BelongsTo
    {
        return $this->belongsTo(San::class, 'MaSan', 'MaSan');
    }

    public function khachHang(): BelongsTo
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }
}
