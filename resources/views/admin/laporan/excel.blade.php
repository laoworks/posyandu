<table>
    <tr>
        <td colspan="4"><strong>Laporan Posyandu</strong></td>
    </tr>
    <tr>
        <td colspan="4">Dibuat pada {{ now()->format('d M Y H:i') }}</td>
    </tr>
    <tr>
        <td colspan="4">Periode data: {{ $period_label }}</td>
    </tr>
    <tr></tr>

    <tr>
        <td><strong>Total Balita</strong></td>
        <td><strong>Penimbangan</strong></td>
        <td><strong>Imunisasi</strong></td>
        <td><strong>Jadwal</strong></td>
    </tr>
    <tr>
        <td>{{ $summary['total_balita'] }}</td>
        <td>{{ $summary['total_penimbangan'] }}</td>
        <td>{{ $summary['total_imunisasi'] }}</td>
        <td>{{ $summary['total_jadwal'] }}</td>
    </tr>
    <tr>
        <td colspan="4">Catatan: Total balita menampilkan jumlah keseluruhan data yang tercatat.</td>
    </tr>

    <tr></tr>
    <tr>
        <td colspan="4"><strong>Penimbangan Terbaru</strong></td>
    </tr>
    <tr>
        <td><strong>Nama Balita</strong></td>
        <td><strong>Tanggal</strong></td>
        <td><strong>Berat Badan</strong></td>
        <td><strong>Tinggi Badan</strong></td>
    </tr>
    @forelse ($penimbanganTerbaru as $item)
        <tr>
            <td>{{ $item->bayi?->nama ?? '-' }}</td>
            <td>{{ optional($item->tanggal)->format('d M Y') }}</td>
            <td>{{ $item->berat_badan }}</td>
            <td>{{ $item->tinggi_badan }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Belum ada data penimbangan.</td>
        </tr>
    @endforelse

    <tr></tr>
    <tr>
        <td colspan="4"><strong>Imunisasi Terbaru</strong></td>
    </tr>
    <tr>
        <td><strong>Nama Balita</strong></td>
        <td><strong>Jenis Imunisasi</strong></td>
        <td><strong>Dosis</strong></td>
        <td><strong>Tanggal</strong></td>
    </tr>
    @forelse ($imunisasiTerbaru as $item)
        <tr>
            <td>{{ $item->bayi?->nama ?? '-' }}</td>
            <td>{{ $item->jenis_imunisasi }}</td>
            <td>{{ $item->dosis }}</td>
            <td>{{ optional($item->tanggal)->format('d M Y') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Belum ada data imunisasi.</td>
        </tr>
    @endforelse

    <tr></tr>
    <tr>
        <td colspan="4"><strong>Jadwal Mendatang</strong></td>
    </tr>
    <tr>
        <td><strong>Judul</strong></td>
        <td><strong>Tanggal</strong></td>
        <td><strong>Jam</strong></td>
        <td><strong>Lokasi</strong></td>
    </tr>
    @forelse ($jadwalMendatang as $item)
        <tr>
            <td>{{ $item->judul }}</td>
            <td>{{ optional($item->tanggal)->format('d M Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
            <td>{{ $item->lokasi }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Belum ada jadwal posyandu.</td>
        </tr>
    @endforelse
</table>
