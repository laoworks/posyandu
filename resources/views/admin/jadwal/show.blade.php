@extends('layouts.admin')

@section('title', 'Detail Jadwal Posyandu')
@section('page-title', 'Detail Jadwal Posyandu')
@section('page-description', 'Lihat rincian jadwal kegiatan posyandu yang telah dicatat.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">Rincian Jadwal Posyandu</h3>
                <p class="mt-1 text-sm text-slate-500">Informasi lengkap jadwal kegiatan untuk pelayanan posyandu.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.jadwal-posyandu.edit', $jadwalPosyandu) }}" class="inline-flex items-center justify-center border border-amber-500 px-4 py-2.5 text-sm font-medium text-amber-600 transition hover:bg-amber-500 hover:text-white">
                    Edit Data
                </a>
                <a href="{{ route('admin.jadwal-posyandu.index') }}" class="inline-flex items-center justify-center border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="grid gap-5 md:grid-cols-2">
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Judul</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $jadwalPosyandu->judul }}</p>
            </div>

            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Lokasi</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $jadwalPosyandu->lokasi }}</p>
            </div>

            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ optional($jadwalPosyandu->tanggal)->format('d M Y') }}</p>
            </div>

            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Jam</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ \Carbon\Carbon::parse($jadwalPosyandu->jam)->format('H:i') }}</p>
            </div>
        </div>

        <div class="mt-5 border border-slate-200 p-4">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Keterangan</p>
            <p class="mt-2 text-sm leading-6 text-slate-700">{{ $jadwalPosyandu->keterangan ?: 'Tidak ada keterangan tambahan.' }}</p>
        </div>
    </div>
</div>
@endsection
