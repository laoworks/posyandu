<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Posyandu</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.5;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0 0 4px;
            font-size: 22px;
            color: #3f37c9;
        }

        .header p {
            margin: 0;
            color: #64748b;
        }

        .summary {
            width: 100%;
            margin-bottom: 22px;
        }

        .summary td {
            width: 25%;
            border: 1px solid #cbd5e1;
            padding: 12px;
            vertical-align: top;
        }

        .summary-label {
            display: block;
            margin-bottom: 8px;
            font-size: 10px;
            text-transform: uppercase;
            color: #64748b;
        }

        .summary-value {
            font-size: 24px;
            font-weight: bold;
            color: #0f172a;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            margin: 0 0 10px;
            font-size: 15px;
            color: #0f172a;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
        }

        table.data-table th,
        table.data-table td {
            border: 1px solid #cbd5e1;
            padding: 8px 10px;
            text-align: left;
        }

        table.data-table th {
            background: #eef2ff;
            color: #312e81;
            font-size: 11px;
        }

        .muted {
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Posyandu</h1>
        <p>Dicetak pada {{ now()->format('d M Y H:i') }}</p>
        <p>Periode data: {{ $period_label }}</p>
    </div>

    <table class="summary">
        <tr>
            <td>
                <span class="summary-label">Total Balita</span>
                <span class="summary-value">{{ number_format($summary['total_balita']) }}</span>
            </td>
            <td>
                <span class="summary-label">Penimbangan</span>
                <span class="summary-value">{{ number_format($summary['total_penimbangan']) }}</span>
            </td>
            <td>
                <span class="summary-label">Imunisasi</span>
                <span class="summary-value">{{ number_format($summary['total_imunisasi']) }}</span>
            </td>
            <td>
                <span class="summary-label">Jadwal</span>
                <span class="summary-value">{{ number_format($summary['total_jadwal']) }}</span>
            </td>
        </tr>
    </table>

    <p class="muted" style="margin-top: -10px; margin-bottom: 18px;">Total balita ditampilkan sebagai jumlah keseluruhan data yang tercatat.</p>

    <div class="section">
        <h2>Penimbangan Terbaru</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Balita</th>
                    <th>Tanggal</th>
                    <th>Berat Badan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penimbanganTerbaru as $item)
                    <tr>
                        <td>{{ $item->bayi?->nama ?? '-' }}</td>
                        <td>{{ optional($item->tanggal)->format('d M Y') }}</td>
                        <td>{{ number_format((float) $item->berat_badan, 2) }} Kg</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="muted">Belum ada data penimbangan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Imunisasi Terbaru</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Balita</th>
                    <th>Jenis Imunisasi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($imunisasiTerbaru as $item)
                    <tr>
                        <td>{{ $item->bayi?->nama ?? '-' }}</td>
                        <td>{{ $item->jenis_imunisasi }}</td>
                        <td>{{ optional($item->tanggal)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="muted">Belum ada data imunisasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Jadwal Mendatang</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwalMendatang as $item)
                    <tr>
                        <td>{{ $item->judul }}</td>
                        <td>{{ optional($item->tanggal)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                        <td>{{ $item->lokasi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="muted">Belum ada jadwal posyandu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
