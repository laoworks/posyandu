<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\JadwalPosyandu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JadwalPosyanduController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->search;

        $jadwals = JadwalPosyandu::when($search, function ($query) use ($search) {
            $query->where(function ($scheduleQuery) use ($search) {
                $scheduleQuery->where('judul', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        })
            ->whereDate('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->paginate(10)
            ->withQueryString();

        return view('orangtua.jadwal.index', compact('jadwals'));
    }

    public function show(JadwalPosyandu $jadwalPosyandu): View
    {
        return view('orangtua.jadwal.show', compact('jadwalPosyandu'));
    }
}
