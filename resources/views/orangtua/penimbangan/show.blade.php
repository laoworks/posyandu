@extends('layouts.orangtua')

@section('title', 'Detail Penimbangan')
@section('page-title', 'Detail Penimbangan')
@section('page-description', 'Lihat detail hasil penimbangan anak Anda.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">Detail Penimbangan</h3>
                <p class="mt-1 text-sm text-slate-500">Informasi hasil penimbangan yang tercatat untuk anak Anda.</p>
            </div>

            <a href="{{ route('orangtua.penimbangan.index') }}" class="inline-flex items-center justify-center border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                Kembali
            </a>
        </div>
    </div>

    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="grid gap-5 md:grid-cols-2">
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Anak</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $penimbangan->bayi?->nama ?? '-' }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ optional($penimbangan->tanggal)->format('d M Y') }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Berat Badan</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ number_format((float) $penimbangan->berat_badan, 2) }} Kg</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tinggi Badan</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ number_format((float) $penimbangan->tinggi_badan, 2) }} Cm</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Lingkar Kepala</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $penimbangan->lingkar_kepala ? number_format((float) $penimbangan->lingkar_kepala, 2).' Cm' : '-' }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Lingkar Lengan</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $penimbangan->lingkar_lengan ? number_format((float) $penimbangan->lingkar_lengan, 2).' Cm' : '-' }}</p>
            </div>
        </div>

        <div class="mt-5 border border-slate-200 p-4">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Catatan</p>
            <p class="mt-2 text-sm leading-6 text-slate-700">{{ $penimbangan->catatan ?: 'Tidak ada catatan tambahan.' }}</p>
        </div>
    </div>
</div>
@endsection
