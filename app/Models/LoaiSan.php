<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoaiSan extends Model
{
    use HasFactory;

    protected $table = 'loaisan';

    protected $primaryKey = 'MaLoai';

    protected $fillable = [
        'TenLoai',
        'MoTa',
    ];

    public function san(): HasMany
    {
        return $this->hasMany(San::class, 'MaLoai', 'MaLoai');
    }

    public function baiDangTimBan(): HasMany
    {
        return $this->hasMany(BaiDangTimBan::class, 'MaLoaiSan', 'MaLoai');
    }
}
