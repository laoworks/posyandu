@extends('layouts.orangtua')

@section('title', 'Detail Anak')
@section('page-title', 'Detail Anak')
@section('page-description', 'Lihat profil anak beserta ringkasan layanan terakhir.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">{{ $anak->nama }}</h3>
                <p class="mt-1 text-sm text-slate-500">Informasi profil anak dan layanan kesehatan terbaru.</p>
            </div>

            <a href="{{ route('orangtua.anak.index') }}" class="inline-flex items-center justify-center border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                Kembali
            </a>
        </div>
    </div>

    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="grid gap-5 md:grid-cols-2">
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Anak</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $anak->nama }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">NIK</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $anak->nik }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Jenis Kelamin</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $anak->jenis_kelamin }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal Lahir</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ optional($anak->tanggal_lahir)->format('d M Y') }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Ayah</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $anak->nama_ayah }}</p>
            </div>
            <div class="border border-slate-200 p-4">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Ibu</p>
                <p class="mt-2 text-sm font-medium text-slate-800">{{ $anak->nama_ibu }}</p>
            </div>
        </div>

        <div class="mt-5 border border-slate-200 p-4">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Alamat</p>
            <p class="mt-2 text-sm leading-6 text-slate-700">{{ $anak->alamat }}</p>
        </div>
    </div>

    <div class="grid gap-5 xl:grid-cols-2">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <h4 class="text-base font-semibold text-slate-800">Penimbangan Terakhir</h4>
            <div class="mt-4 space-y-3">
                @forelse ($anak->penimbangan as $item)
                    <div class="border border-slate-200 p-3">
                        <p class="text-sm font-medium text-slate-800">{{ optional($item->tanggal)->format('d M Y') }}</p>
                        <p class="mt-1 text-sm text-slate-500">Berat {{ number_format((float) $item->berat_badan, 2) }} Kg · Tinggi {{ number_format((float) $item->tinggi_badan, 2) }} Cm</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada riwayat penimbangan.</p>
                @endforelse
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <h4 class="text-base font-semibold text-slate-800">Imunisasi Terakhir</h4>
            <div class="mt-4 space-y-3">
                @forelse ($anak->imunisasi as $item)
                    <div class="border border-slate-200 p-3">
                        <p class="text-sm font-medium text-slate-800">{{ $item->jenis_imunisasi }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ optional($item->tanggal)->format('d M Y') }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada riwayat imunisasi.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
