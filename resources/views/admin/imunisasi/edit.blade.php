@extends('layouts.admin')

@section('title', 'Edit Imunisasi')
@section('page-title', 'Edit Imunisasi')
@section('page-description', 'Perbarui data imunisasi balita yang sudah tercatat.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div>
            <h3 class="text-xl font-semibold text-slate-800">Edit Data Imunisasi</h3>
            <p class="mt-1 text-sm text-slate-500">Sesuaikan data pelayanan imunisasi bila ada perubahan atau koreksi.</p>
        </div>
    </div>

    <form action="{{ route('admin.imunisasi.update', $imunisasi) }}" method="POST" class="border border-slate-200 bg-white p-5 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="bayi_balita_id" class="mb-2 block text-sm font-medium text-slate-700">Nama Balita</label>
                <select id="bayi_balita_id" name="bayi_balita_id" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                    <option value="">Pilih balita</option>
                    @foreach ($balitas as $balita)
                        <option value="{{ $balita->id }}" @selected(old('bayi_balita_id', $imunisasi->bayi_balita_id) == $balita->id)>
                            {{ $balita->nama }} - {{ $balita->nik }}
                        </option>
                    @endforeach
                </select>
                @error('bayi_balita_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal" class="mb-2 block text-sm font-medium text-slate-700">Tanggal Imunisasi</label>
                <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', optional($imunisasi->tanggal)->format('Y-m-d')) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('tanggal')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jenis_imunisasi" class="mb-2 block text-sm font-medium text-slate-700">Jenis Imunisasi</label>
                <input id="jenis_imunisasi" type="text" name="jenis_imunisasi" value="{{ old('jenis_imunisasi', $imunisasi->jenis_imunisasi) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('jenis_imunisasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="dosis" class="mb-2 block text-sm font-medium text-slate-700">Dosis</label>
                <input id="dosis" type="text" name="dosis" value="{{ old('dosis', $imunisasi->dosis) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('dosis')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-5">
            <label for="keterangan" class="mb-2 block text-sm font-medium text-slate-700">Keterangan</label>
            <textarea id="keterangan" name="keterangan" rows="4" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">{{ old('keterangan', $imunisasi->keterangan) }}</textarea>
            @error('keterangan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ route('admin.imunisasi.index') }}" class="border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                Kembali
            </a>
            <button type="submit" class="border border-[#3f37c9] bg-[#3f37c9] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead] hover:shadow focus:outline-none focus:ring-2 focus:ring-[#3f37c9]/20">
                Update Data
            </button>
        </div>
    </form>
</div>
@endsection
