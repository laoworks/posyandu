<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\Imunisasi;
use App\Models\JadwalPosyandu;
use App\Models\Penimbangan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $anak = $user?->anak()
            ->latest()
            ->get() ?? collect();

        $anakIds = $anak->pluck('id');

        $summary = [
            'total_anak' => $anak->count(),
            'total_imunisasi' => Imunisasi::whereIn('bayi_balita_id', $anakIds)->count(),
            'total_penimbangan' => Penimbangan::whereIn('bayi_balita_id', $anakIds)->count(),
            'total_jadwal' => JadwalPosyandu::whereDate('tanggal', '>=', today())->count(),
        ];

        $penimbanganTerbaru = Penimbangan::with('bayi')
            ->whereIn('bayi_balita_id', $anakIds)
            ->latest()
            ->take(5)
            ->get();

        $imunisasiTerbaru = Imunisasi::with('bayi')
            ->whereIn('bayi_balita_id', $anakIds)
            ->latest()
            ->take(5)
            ->get();

        $jadwalMendatang = JadwalPosyandu::whereDate('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->take(5)
            ->get();

        return view('orangtua.dashboard', compact(
            'summary',
            'anak',
            'penimbanganTerbaru',
            'imunisasiTerbaru',
            'jadwalMendatang'
        ));
    }
}
