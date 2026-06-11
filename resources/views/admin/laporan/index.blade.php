@extends('layouts.admin')

@section('title', 'Laporan')
@section('page-title', 'Laporan')
@section('page-description', 'Lihat ringkasan data layanan posyandu dalam satu halaman yang mudah dipantau.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">Ringkasan Laporan Posyandu</h3>
                <p class="mt-1 text-sm text-slate-500">Halaman ini menampilkan gambaran singkat data balita, penimbangan, imunisasi, dan jadwal layanan.</p>
                <p class="mt-2 text-sm font-medium text-[#3f37c9]">Periode: {{ $period_label }}</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a
                    href="{{ route('admin.laporan.pdf', request()->only(['tanggal_mulai', 'tanggal_selesai'])) }}"
                    class="inline-flex items-center justify-center border border-[#3f37c9] bg-[#3f37c9] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead]"
                >
                    Export PDF
                </a>
                <a
                    href="{{ route('admin.laporan.excel', request()->only(['tanggal_mulai', 'tanggal_selesai'])) }}"
                    class="inline-flex items-center justify-center border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:border-[#3f37c9] hover:text-[#3f37c9]"
                >
                    Export Excel
                </a>
            </div>
        </div>
    </div>

    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="grid gap-4 lg:grid-cols-[1fr_1fr_auto_auto] lg:items-end">
            <div>
                <label for="tanggal_mulai" class="mb-2 block text-sm font-medium text-slate-700">Dari Tanggal</label>
                <input
                    type="date"
                    name="tanggal_mulai"
                    id="tanggal_mulai"
                    value="{{ $filters['tanggal_mulai'] ?? '' }}"
                    class="w-full border border-slate-300 px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9] focus:ring-2 focus:ring-[#3f37c9]/10"
                >
            </div>

            <div>
                <label for="tanggal_selesai" class="mb-2 block text-sm font-medium text-slate-700">Sampai Tanggal</label>
                <input
                    type="date"
                    name="tanggal_selesai"
                    id="tanggal_selesai"
                    value="{{ $filters['tanggal_selesai'] ?? '' }}"
                    class="w-full border border-slate-300 px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9] focus:ring-2 focus:ring-[#3f37c9]/10"
                >
            </div>

            <button
                type="submit"
                class="inline-flex items-center justify-center border border-[#3f37c9] bg-[#3f37c9] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead]"
            >
                Terapkan Filter
            </button>

            <a
                href="{{ route('admin.laporan.index') }}"
                class="inline-flex items-center justify-center border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:border-slate-400"
            >
                Reset
            </a>
        </form>

        @error('tanggal_mulai')
            <p class="mt-3 text-sm text-rose-600">{{ $message }}</p>
        @enderror

        @error('tanggal_selesai')
            <p class="mt-3 text-sm text-rose-600">{{ $message }}</p>
        @enderror

        @if ($hasFilter)
            <p class="mt-4 text-sm text-slate-500">Data yang tampil dan file export akan mengikuti periode yang sedang dipilih.</p>
        @endif
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Total Balita</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_balita']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Jumlah data balita yang tercatat secara keseluruhan.</p>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Penimbangan</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_penimbangan']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Total data hasil penimbangan.</p>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Imunisasi</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_imunisasi']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Total pelayanan imunisasi tercatat.</p>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Jadwal</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_jadwal']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Jumlah jadwal posyandu tersedia.</p>
        </div>
    </div>

    <div class="grid gap-5 xl:grid-cols-3">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h4 class="text-base font-semibold text-slate-800">Penimbangan Terbaru</h4>
                <a href="{{ route('admin.penimbangan.index') }}" class="text-sm font-medium text-[#3f37c9] hover:underline">Lihat Semua</a>
            </div>

            <div class="mt-4 space-y-3">
                @forelse ($penimbanganTerbaru as $item)
                    <div class="border border-slate-200 p-3">
                        <p class="text-sm font-medium text-slate-800">{{ $item->bayi?->nama ?? '-' }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal)->format('d M Y') }} · {{ number_format((float) $item->berat_badan, 2) }} Kg</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada data penimbangan.</p>
                @endforelse
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h4 class="text-base font-semibold text-slate-800">Imunisasi Terbaru</h4>
                <a href="{{ route('admin.imunisasi.index') }}" class="text-sm font-medium text-[#3f37c9] hover:underline">Lihat Semua</a>
            </div>

            <div class="mt-4 space-y-3">
                @forelse ($imunisasiTerbaru as $item)
                    <div class="border border-slate-200 p-3">
                        <p class="text-sm font-medium text-slate-800">{{ $item->bayi?->nama ?? '-' }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $item->jenis_imunisasi }} · {{ optional($item->tanggal)->format('d M Y') }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada data imunisasi.</p>
                @endforelse
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h4 class="text-base font-semibold text-slate-800">Jadwal Mendatang</h4>
                <a href="{{ route('admin.jadwal-posyandu.index') }}" class="text-sm font-medium text-[#3f37c9] hover:underline">Lihat Semua</a>
            </div>

            <div class="mt-4 space-y-3">
                @forelse ($jadwalMendatang as $item)
                    <div class="border border-slate-200 p-3">
                        <p class="text-sm font-medium text-slate-800">{{ $item->judul }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal)->format('d M Y') }} · {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $item->lokasi }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada jadwal posyandu.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
