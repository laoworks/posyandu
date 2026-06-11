@extends('layouts.orangtua')

@section('title', 'Detail Imunisasi')
@section('page-title', 'Detail Imunisasi')
@section('page-description', 'Lihat detail riwayat imunisasi anak Anda.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">Detail Imunisasi</h3>
                <p class="mt-1 text-sm text-slate-500">Informasi layanan imunisasi yang tercatat untuk anak Anda.</p>
            </div>

            <a href="{{ route('orangtua.imunisasi.index') }}" class="inline-flex items-center justify-center border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                Kembali
            </a>
        </div>
    </div>

    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="grid gap-5 md:grid-cols-2">
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Anak</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $imunisasi->bayi?->nama ?? '-' }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ optional($imunisasi->tanggal)->format('d M Y') }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Jenis Imunisasi</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $imunisasi->jenis_imunisasi }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Dosis</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $imunisasi->dosis ?: '-' }}</p>
            </div>
        </div>

        <div class="mt-5 border border-slate-200 p-4">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Keterangan</p>
            <p class="mt-2 text-sm leading-6 text-slate-700">{{ $imunisasi->keterangan ?: 'Tidak ada keterangan tambahan.' }}</p>
        </div>
    </div>
</div>
@endsection
