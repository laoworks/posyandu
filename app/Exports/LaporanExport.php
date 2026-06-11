<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    public function __construct(
        private readonly array $reportData
    ) {
    }

    public function view(): View
    {
        return view('admin.laporan.excel', $this->reportData);
    }
}
