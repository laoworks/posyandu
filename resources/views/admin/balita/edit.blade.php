@extends('layouts.admin')

@section('title', 'Edit Balita')
@section('page-title', 'Edit Balita')
@section('page-description', 'Perbarui data balita yang sudah terdaftar di sistem.')

@section('content')
<div class="max-w-6xl">
    <form
        action="{{ route('admin.balita.update', $balitum) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5"
    >
        @csrf
        @method('PUT')

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Data Balita</h3>
                    <p class="mt-1 text-sm text-slate-500">Perbarui identitas dasar dan data kelahiran balita.</p>
                </div>

                @if ($balitum->foto)
                    <img
                        src="{{ asset('storage/'.$balitum->foto) }}"
                        alt="{{ $balitum->nama }}"
                        class="h-16 w-16 border border-slate-200 object-cover"
                    >
                @endif
            </div>

            <div class="mt-5 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik', $balitum->nik) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('nik')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Nama Balita</label>
                    <input type="text" name="nama" value="{{ old('nama', $balitum->nama) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                        <option value="">Pilih</option>
                        <option value="L" @selected(old('jenis_kelamin', $balitum->jenis_kelamin) === 'L')>Laki-Laki</option>
                        <option value="P" @selected(old('jenis_kelamin', $balitum->jenis_kelamin) === 'P')>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $balitum->tempat_lahir) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('tempat_lahir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($balitum->tanggal_lahir)->format('Y-m-d')) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('tanggal_lahir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Berat Lahir (Kg)</label>
                    <input type="number" step="0.01" name="berat_lahir" value="{{ old('berat_lahir', $balitum->berat_lahir) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('berat_lahir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Tinggi Lahir (Cm)</label>
                    <input type="number" step="0.01" name="tinggi_lahir" value="{{ old('tinggi_lahir', $balitum->tinggi_lahir) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('tinggi_lahir')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2 xl:col-span-1">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Foto Balita</label>
                    <input type="file" name="foto" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition file:mr-3 file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-sm file:font-medium">
                    @error('foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-800">Data Orang Tua</h3>
            <p class="mt-1 text-sm text-slate-500">Perbarui data pendamping atau orang tua balita.</p>

            <div class="mt-5 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Nama Ayah</label>
                    <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $balitum->nama_ayah) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('nama_ayah')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Nama Ibu</label>
                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $balitum->nama_ibu) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('nama_ibu')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">No HP Orang Tua</label>
                    <input type="text" name="no_hp_ortu" value="{{ old('no_hp_ortu', $balitum->no_hp_ortu) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('no_hp_ortu')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Alamat</label>
                    <textarea name="alamat" rows="4" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">{{ old('alamat', $balitum->alamat) }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex flex-wrap justify-end gap-3">
            <a href="{{ route('admin.balita.index') }}" class="border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                Kembali
            </a>
            <button type="submit" class="border border-[#3f37c9] bg-[#3f37c9] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead] hover:shadow focus:outline-none focus:ring-2 focus:ring-[#3f37c9]/20">
                Update Data
            </button>
        </div>
    </form>
</div>
@endsection
