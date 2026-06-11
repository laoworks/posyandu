@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Pantau ringkasan data posyandu, layanan terbaru, dan jadwal terdekat dari satu halaman.')

@section('content')
<div class="space-y-5">
    <section class="grid gap-5 xl:grid-cols-[1.7fr_1fr]">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#3f37c9]">Ringkasan Kader</p>
            <h3 class="mt-3 text-2xl font-semibold text-slate-800">Semua data layanan posyandu bisa dipantau lebih cepat dari dashboard ini.</h3>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">
                Gunakan halaman ini untuk melihat jumlah data utama, memantau aktivitas terbaru, dan berpindah ke menu pengelolaan tanpa harus membuka banyak halaman terlebih dahulu.
            </p>
            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('admin.balita.index') }}" class="inline-flex items-center justify-center border border-[#3f37c9] bg-[#3f37c9] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead]">
                    Kelola Data Balita
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center justify-center border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:border-[#3f37c9] hover:text-[#3f37c9]">
                    Buka Laporan
                </a>
                <a href="{{ route('admin.jadwal-posyandu.index') }}" class="inline-flex items-center justify-center border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:border-[#3f37c9] hover:text-[#3f37c9]">
                    Lihat Jadwal
                </a>
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Status Hari Ini</p>
            <div class="mt-4 space-y-4">
                <div class="border border-slate-200 p-4">
                    <p class="text-sm text-slate-500">Tanggal</p>
                    <p class="mt-1 text-base font-semibold text-slate-800">{{ now()->translatedFormat('d F Y') }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-sm text-slate-500">Layanan Hari Ini</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-800">{{ number_format($summary['layanan_hari_ini']) }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-sm text-slate-500">Jadwal 7 Hari Ke Depan</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-800">{{ number_format($summary['jadwal_minggu_ini']) }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Total Balita</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_balita']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Jumlah data balita yang saat ini tercatat di sistem.</p>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Penimbangan</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_penimbangan']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Riwayat penimbangan yang sudah diinput petugas.</p>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Imunisasi</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_imunisasi']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Catatan pelayanan imunisasi yang tersimpan.</p>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Jadwal Posyandu</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_jadwal']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Jadwal kegiatan yang sudah dibuat di sistem.</p>
        </div>
    </section>

    <section class="grid gap-5 xl:grid-cols-3">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h4 class="text-base font-semibold text-slate-800">Balita Terbaru</h4>
                <a href="{{ route('admin.balita.index') }}" class="text-sm font-medium text-[#3f37c9] hover:underline">Lihat Semua</a>
            </div>

            <div class="mt-4 space-y-3">
                @forelse ($balitaTerbaru as $item)
                    <div class="border border-slate-200 p-3">
                        <p class="text-sm font-medium text-slate-800">{{ $item->nama }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $item->nik }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal_lahir)->format('d M Y') }} · {{ $item->jenis_kelamin }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada data balita.</p>
                @endforelse
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h4 class="text-base font-semibold text-slate-800">Penimbangan Terbaru</h4>
                <a href="{{ route('admin.penimbangan.index') }}" class="text-sm font-medium text-[#3f37c9] hover:underline">Lihat Semua</a>
            </div>

            <div class="mt-4 space-y-3">
                @forelse ($penimbanganTerbaru as $item)
                    <div class="border border-slate-200 p-3">
                        <p class="text-sm font-medium text-slate-800">{{ $item->bayi?->nama ?? '-' }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal)->format('d M Y') }}</p>
                        <p class="mt-1 text-sm text-slate-500">Berat {{ number_format((float) $item->berat_badan, 2) }} Kg</p>
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
                        <p class="mt-1 text-sm text-slate-500">{{ $item->jenis_imunisasi }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal)->format('d M Y') }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada data imunisasi.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="grid gap-5 xl:grid-cols-[1.3fr_1fr]">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h4 class="text-base font-semibold text-slate-800">Jadwal Mendatang</h4>
                <a href="{{ route('admin.jadwal-posyandu.index') }}" class="text-sm font-medium text-[#3f37c9] hover:underline">Lihat Semua</a>
            </div>

            <div class="mt-4 space-y-3">
                @forelse ($jadwalMendatang as $item)
                    <div class="border border-slate-200 p-4">
                        <p class="text-sm font-medium text-slate-800">{{ $item->judul }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal)->format('d M Y') }} · {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $item->lokasi }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada jadwal posyandu yang akan datang.</p>
                @endforelse
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <h4 class="text-base font-semibold text-slate-800">Akses Cepat</h4>
            <div class="mt-4 grid gap-3">
                <a href="{{ route('admin.balita.create') }}" class="border border-slate-200 p-4 transition hover:border-[#3f37c9]">
                    <p class="text-sm font-semibold text-slate-800">Tambah Data Balita</p>
                    <p class="mt-1 text-sm text-slate-500">Input data balita baru ke sistem.</p>
                </a>
                <a href="{{ route('admin.penimbangan.create') }}" class="border border-slate-200 p-4 transition hover:border-[#3f37c9]">
                    <p class="text-sm font-semibold text-slate-800">Input Penimbangan</p>
                    <p class="mt-1 text-sm text-slate-500">Catat hasil penimbangan terbaru.</p>
                </a>
                <a href="{{ route('admin.imunisasi.create') }}" class="border border-slate-200 p-4 transition hover:border-[#3f37c9]">
                    <p class="text-sm font-semibold text-slate-800">Input Imunisasi</p>
                    <p class="mt-1 text-sm text-slate-500">Tambahkan catatan imunisasi balita.</p>
                </a>
                <a href="{{ route('admin.jadwal-posyandu.create') }}" class="border border-slate-200 p-4 transition hover:border-[#3f37c9]">
                    <p class="text-sm font-semibold text-slate-800">Tambah Jadwal Posyandu</p>
                    <p class="mt-1 text-sm text-slate-500">Susun kegiatan pelayanan berikutnya.</p>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
