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

    public function danhSachSan(Request $request): View
    {
        $loaiSanList = LoaiSan::withCount('san')->get();

        $query = San::with('loaiSan');

        if ($request->filled('loai')) {
            $query->where('MaLoai', $request->input('loai'));
        }

        if ($request->filled('search')) {
            $query->where('TenSan', 'like', '%'.$request->input('search').'%');
        }

        $courts = $query->paginate(9)->withQueryString();

        return view('courts', compact('courts', 'loaiSanList'));
    }

    public function booking(Request $request): View
    {
        $loaiSanList = LoaiSan::withCount('san')->get();
        $allSan = San::with('loaiSan')->get();

        return view('booking', compact('loaiSanList', 'allSan'));
    }
}
