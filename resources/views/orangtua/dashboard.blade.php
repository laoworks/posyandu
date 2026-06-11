@extends('layouts.orangtua')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Pantau data anak, riwayat layanan, dan jadwal posyandu dari satu halaman yang mudah dipantau.')

@section('content')
<div class="space-y-5">
    <section class="grid gap-5 xl:grid-cols-[1.7fr_1fr]">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#3f37c9]">Pemantauan Keluarga</p>
            <h3 class="mt-3 text-2xl font-semibold text-slate-800">Data anak, jadwal posyandu, dan riwayat layanan bisa dilihat lebih ringkas dari dashboard ini.</h3>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">
                Halaman ini membantu orang tua memantau perkembangan anak yang terdaftar, melihat hasil layanan terakhir, dan mengecek jadwal posyandu yang akan datang tanpa harus membuka banyak halaman.
            </p>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Status Akun</p>
            <div class="mt-4 space-y-4">
                <div class="border border-slate-200 p-4">
                    <p class="text-sm text-slate-500">Nama Pengguna</p>
                    <p class="mt-1 text-base font-semibold text-slate-800">{{ auth()->user()->name }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-sm text-slate-500">Tanggal Hari Ini</p>
                    <p class="mt-1 text-base font-semibold text-slate-800">{{ now()->translatedFormat('d F Y') }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-sm text-slate-500">Anak Terdaftar</p>
                    <p class="mt-1 text-2xl font-semibold text-slate-800">{{ number_format($summary['total_anak']) }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Data Anak</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_anak']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Jumlah anak yang terhubung ke akun orang tua ini.</p>
        </div>
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Riwayat Imunisasi</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_imunisasi']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Jumlah layanan imunisasi untuk anak yang terdaftar.</p>
        </div>
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Riwayat Penimbangan</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_penimbangan']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Jumlah catatan penimbangan yang sudah tersimpan.</p>
        </div>
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Jadwal Mendatang</p>
            <p class="mt-3 text-3xl font-semibold text-slate-800">{{ number_format($summary['total_jadwal']) }}</p>
            <p class="mt-2 text-sm text-slate-500">Jumlah jadwal posyandu yang akan datang.</p>
        </div>
    </section>

    <section class="grid gap-5 xl:grid-cols-3">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h4 class="text-base font-semibold text-slate-800">Data Anak</h4>
                <span class="text-sm font-medium text-[#3f37c9]">Profil Terhubung</span>
            </div>

            <div class="mt-4 space-y-3">
                @forelse ($anak as $item)
                    <div class="border border-slate-200 p-3">
                        <p class="text-sm font-medium text-slate-800">{{ $item->nama }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $item->nik }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal_lahir)->format('d M Y') }} · {{ $item->jenis_kelamin }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada data anak yang terhubung ke akun ini.</p>
                @endforelse
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h4 class="text-base font-semibold text-slate-800">Riwayat Penimbangan</h4>
                <span class="text-sm font-medium text-[#3f37c9]">Layanan Terbaru</span>
            </div>

            <div class="mt-4 space-y-3">
                @forelse ($penimbanganTerbaru as $item)
                    <div class="border border-slate-200 p-3">
                        <p class="text-sm font-medium text-slate-800">{{ $item->bayi?->nama ?? '-' }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal)->format('d M Y') }}</p>
                        <p class="mt-1 text-sm text-slate-500">Berat {{ number_format((float) $item->berat_badan, 2) }} Kg · Tinggi {{ number_format((float) $item->tinggi_badan, 2) }} Cm</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada riwayat penimbangan untuk anak Anda.</p>
                @endforelse
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h4 class="text-base font-semibold text-slate-800">Riwayat Imunisasi</h4>
                <span class="text-sm font-medium text-[#3f37c9]">Layanan Terbaru</span>
            </div>

            <div class="mt-4 space-y-3">
                @forelse ($imunisasiTerbaru as $item)
                    <div class="border border-slate-200 p-3">
                        <p class="text-sm font-medium text-slate-800">{{ $item->bayi?->nama ?? '-' }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $item->jenis_imunisasi }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal)->format('d M Y') }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada riwayat imunisasi untuk anak Anda.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="grid gap-5 xl:grid-cols-[1.3fr_1fr]">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h4 class="text-base font-semibold text-slate-800">Jadwal Posyandu Mendatang</h4>
                <span class="text-sm font-medium text-[#3f37c9]">Informasi Layanan</span>
            </div>

            <div class="mt-4 space-y-3">
                @forelse ($jadwalMendatang as $item)
                    <div class="border border-slate-200 p-4">
                        <p class="text-sm font-medium text-slate-800">{{ $item->judul }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal)->format('d M Y') }} · {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $item->lokasi }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $item->keterangan ?: 'Tidak ada keterangan tambahan.' }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada jadwal posyandu yang tersedia.</p>
                @endforelse
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <h4 class="text-base font-semibold text-slate-800">Informasi Singkat</h4>
            <div class="mt-4 grid gap-3">
                <div class="border border-slate-200 p-4">
                    <p class="text-sm font-semibold text-slate-800">Pantau layanan anak</p>
                    <p class="mt-1 text-sm text-slate-500">Riwayat penimbangan dan imunisasi terbaru langsung tampil di dashboard.</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-sm font-semibold text-slate-800">Cek jadwal lebih cepat</p>
                    <p class="mt-1 text-sm text-slate-500">Jadwal pelayanan mendatang bisa dilihat tanpa harus menunggu pengumuman manual.</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-sm font-semibold text-slate-800">Data mengikuti akun login</p>
                    <p class="mt-1 text-sm text-slate-500">Dashboard hanya menampilkan data anak yang terhubung dengan akun orang tua ini.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
