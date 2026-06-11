@extends('layouts.bidan')

@section('title', 'Detail Balita')
@section('page-title', 'Detail Balita')
@section('page-description', 'Informasi lengkap balita dan data orang tua yang terdaftar.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-5 md:flex-row md:items-start md:justify-between">
            <div class="flex items-start gap-4">
                <img
                    src="{{ $balitum->foto ? asset('storage/'.$balitum->foto) : 'https://ui-avatars.com/api/?name='.urlencode($balitum->nama).'&background=EEF2FF&color=3f37c9' }}"
                    alt="{{ $balitum->nama }}"
                    class="h-20 w-20 border border-slate-200 object-cover"
                >

                <div>
                    <h3 class="text-xl font-semibold text-slate-800">{{ $balitum->nama }}</h3>
                    <p class="mt-1 text-sm text-slate-500">NIK: {{ $balitum->nik }}</p>
                    <p class="mt-1 text-sm text-slate-500">
                        {{ $balitum->jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' }} Â·
                        {{ optional($balitum->tanggal_lahir)->format('d M Y') }}
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('bidan.balita.edit', $balitum) }}" class="inline-flex min-w-[108px] items-center justify-center border border-amber-500 px-4 py-2.5 text-sm font-medium text-amber-600 transition hover:bg-amber-500 hover:text-white">
                    Edit Data
                </a>
                <a href="{{ route('bidan.balita.index') }}" class="inline-flex min-w-[108px] items-center justify-center border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid gap-5 xl:grid-cols-2">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-800">Data Balita</h3>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Nama</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $balitum->nama }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">NIK</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $balitum->nik }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Jenis Kelamin</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $balitum->jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan' }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Tempat Lahir</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $balitum->tempat_lahir }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Tanggal Lahir</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ optional($balitum->tanggal_lahir)->format('d M Y') }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Berat Lahir</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $balitum->berat_lahir ? $balitum->berat_lahir.' Kg' : '-' }}</p>
                </div>
                <div class="border border-slate-200 p-4 md:col-span-2">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Tinggi Lahir</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $balitum->tinggi_lahir ? $balitum->tinggi_lahir.' Cm' : '-' }}</p>
                </div>
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-800">Data Orang Tua</h3>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Nama Ayah</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $balitum->nama_ayah }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Nama Ibu</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $balitum->nama_ibu }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">No HP Orang Tua</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $balitum->no_hp_ortu ?: '-' }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Terhubung ke Akun</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $balitum->orangTua?->name ?: '-' }}</p>
                </div>
                <div class="border border-slate-200 p-4 md:col-span-2">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Alamat</p>
                    <p class="mt-2 text-sm leading-6 text-slate-700">{{ $balitum->alamat }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

