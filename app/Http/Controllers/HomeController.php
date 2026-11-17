<?php

namespace App\Http\Controllers;

use App\Models\BaiDangTimBan;
use App\Models\HangThanhVien;
use App\Models\LoaiSan;
use App\Models\San;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $loaiSanList = LoaiSan::withCount('san')->with('san')->get();
        $allSan = San::with('loaiSan')->get();
        $hangThanhVienList = HangThanhVien::orderBy('ChiTieuToiThieu', 'asc')->get();
        $keoHot = BaiDangTimBan::with(['nguoiDang', 'loaiSan'])->latest()->take(3)->get();

        return view('welcome', compact('loaiSanList', 'allSan', 'hangThanhVienList', 'keoHot'));
    }
}
