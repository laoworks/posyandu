@extends('layouts.bidan')

@section('title', 'Edit Jadwal Posyandu')
@section('page-title', 'Edit Jadwal Posyandu')
@section('page-description', 'Perbarui jadwal kegiatan posyandu yang sudah tercatat.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div>
            <h3 class="text-xl font-semibold text-slate-800">Edit Jadwal Posyandu</h3>
            <p class="mt-1 text-sm text-slate-500">Sesuaikan informasi jadwal bila ada perubahan waktu atau lokasi kegiatan.</p>
        </div>
    </div>

    <form action="{{ route('bidan.jadwal-posyandu.update', $jadwalPosyandu) }}" method="POST" class="border border-slate-200 bg-white p-5 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="judul" class="mb-2 block text-sm font-medium text-slate-700">Judul</label>
                <input id="judul" type="text" name="judul" value="{{ old('judul', $jadwalPosyandu->judul) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('judul')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lokasi" class="mb-2 block text-sm font-medium text-slate-700">Lokasi</label>
                <input id="lokasi" type="text" name="lokasi" value="{{ old('lokasi', $jadwalPosyandu->lokasi) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('lokasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal" class="mb-2 block text-sm font-medium text-slate-700">Tanggal</label>
                <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', optional($jadwalPosyandu->tanggal)->format('Y-m-d')) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('tanggal')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jam" class="mb-2 block text-sm font-medium text-slate-700">Jam</label>
                <input id="jam" type="time" name="jam" value="{{ old('jam', $jadwalPosyandu->jam) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('jam')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-5">
            <label for="keterangan" class="mb-2 block text-sm font-medium text-slate-700">Keterangan</label>
            <textarea id="keterangan" name="keterangan" rows="4" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">{{ old('keterangan', $jadwalPosyandu->keterangan) }}</textarea>
            @error('keterangan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ route('bidan.jadwal-posyandu.index') }}" class="border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                Kembali
            </a>
            <button type="submit" class="border border-[#3f37c9] bg-[#3f37c9] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead] hover:shadow focus:outline-none focus:ring-2 focus:ring-[#3f37c9]/20">
                Update Data
            </button>
        </div>
    </form>
</div>
@endsection

