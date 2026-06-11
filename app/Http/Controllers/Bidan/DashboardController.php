<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\BayiBalita;
use App\Models\Imunisasi;
use App\Models\JadwalPosyandu;
use App\Models\Penimbangan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $summary = [
            'total_balita' => BayiBalita::count(),
            'total_penimbangan' => Penimbangan::count(),
            'total_imunisasi' => Imunisasi::count(),
            'total_jadwal' => JadwalPosyandu::count(),
            'layanan_hari_ini' => Penimbangan::whereDate('tanggal', today())->count()
                + Imunisasi::whereDate('tanggal', today())->count(),
            'jadwal_minggu_ini' => JadwalPosyandu::whereBetween('tanggal', [today(), today()->copy()->addDays(7)])->count(),
        ];

        $balitaTerbaru = BayiBalita::latest()->take(5)->get();
        $penimbanganTerbaru = Penimbangan::with('bayi')->latest()->take(5)->get();
        $imunisasiTerbaru = Imunisasi::with('bayi')->latest()->take(5)->get();
        $jadwalMendatang = JadwalPosyandu::whereDate('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->take(5)
            ->get();

        return view('bidan.dashboard', compact(
            'summary',
            'balitaTerbaru',
            'penimbanganTerbaru',
            'imunisasiTerbaru',
            'jadwalMendatang'
        ));
    }
}
