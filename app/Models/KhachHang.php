<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];

    public function taiKhoan(): BelongsTo
    {
        return $this->belongsTo(TaiKhoan::class, 'MaTK', 'MaTK');
    }
}
