<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaporanExport;
use App\Http\Controllers\Controller;
use App\Models\BayiBalita;
use App\Models\Imunisasi;
use App\Models\JadwalPosyandu;
use App\Models\Penimbangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.laporan.index', $this->getReportData($request));
    }

    public function exportPdf(Request $request)
    {
        $reportData = $this->getReportData($request);

        $pdf = Pdf::loadView('admin.laporan.pdf', $reportData)
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-posyandu-' . $reportData['file_suffix'] . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $reportData = $this->getReportData($request);

        return Excel::download(
            new LaporanExport($reportData),
            'laporan-posyandu-' . $reportData['file_suffix'] . '.xlsx'
        );
    }

    private function getReportData(Request $request): array
    {
        $filters = $request->validate([
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_selesai' => ['nullable', 'date', 'after_or_equal:tanggal_mulai'],
        ]);

        $penimbanganQuery = Penimbangan::with('bayi');
        $imunisasiQuery = Imunisasi::with('bayi');
        $jadwalQuery = JadwalPosyandu::query();

        $this->applyDateFilter($penimbanganQuery, 'tanggal', $filters);
        $this->applyDateFilter($imunisasiQuery, 'tanggal', $filters);
        $this->applyDateFilter($jadwalQuery, 'tanggal', $filters);

        return [
            'summary' => [
                'total_balita' => BayiBalita::count(),
                'total_penimbangan' => (clone $penimbanganQuery)->count(),
                'total_imunisasi' => (clone $imunisasiQuery)->count(),
                'total_jadwal' => (clone $jadwalQuery)->count(),
            ],
            'filters' => $filters,
            'hasFilter' => filled($filters['tanggal_mulai'] ?? null) || filled($filters['tanggal_selesai'] ?? null),
            'period_label' => $this->formatPeriodLabel($filters),
            'file_suffix' => $this->buildFileSuffix($filters),
            'penimbanganTerbaru' => $penimbanganQuery
                ->latest()
                ->take(10)
                ->get(),
            'imunisasiTerbaru' => $imunisasiQuery
                ->latest()
                ->take(10)
                ->get(),
            'jadwalMendatang' => $jadwalQuery
                ->orderBy('tanggal')
                ->orderBy('jam')
                ->take(10)
                ->get(),
        ];
    }

    private function applyDateFilter(Builder $query, string $column, array $filters): void
    {
        if (filled($filters['tanggal_mulai'] ?? null)) {
            $query->whereDate($column, '>=', $filters['tanggal_mulai']);
        }

        if (filled($filters['tanggal_selesai'] ?? null)) {
            $query->whereDate($column, '<=', $filters['tanggal_selesai']);
        }
    }

    private function formatPeriodLabel(array $filters): string
    {
        $start = $filters['tanggal_mulai'] ?? null;
        $end = $filters['tanggal_selesai'] ?? null;

        if ($start && $end) {
            return date('d M Y', strtotime($start)) . ' - ' . date('d M Y', strtotime($end));
        }

        if ($start) {
            return 'Mulai ' . date('d M Y', strtotime($start));
        }

        if ($end) {
            return 'Sampai ' . date('d M Y', strtotime($end));
        }

        return 'Semua periode';
    }

    private function buildFileSuffix(array $filters): string
    {
        $start = $filters['tanggal_mulai'] ?? null;
        $end = $filters['tanggal_selesai'] ?? null;

        if ($start || $end) {
            return ($start ?: 'awal') . '-sampai-' . ($end ?: 'sekarang');
        }

        return now()->format('Y-m-d');
    }
}
