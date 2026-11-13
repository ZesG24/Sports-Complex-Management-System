<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HangThanhVien extends Model
{
    use HasFactory;

    protected $table = 'hangthanhvien';

    protected $primaryKey = 'MaHang';

    protected $fillable = [
        'TenHang',
        'ChiTieuToiThieu',
        'PhanTramGiamGia',
        'QuyenLoi',
    ];

    protected function casts(): array
    {
        return [
            'ChiTieuToiThieu' => 'decimal:2',
            'PhanTramGiamGia' => 'decimal:2',
        ];
    }

    public function khachHang(): HasMany
    {
        return $this->hasMany(KhachHang::class, 'MaHang', 'MaHang');
    }
}
