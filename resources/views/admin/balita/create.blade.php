@extends('layouts.admin')

@section('title', 'Tambah Balita')
@section('page-title', 'Tambah Balita')
@section('page-description', 'Masukkan data balita baru dengan form yang lebih ringkas dan rapi.')

@section('content')

<div class="max-w-6xl">

```
@if ($errors->any())
    <div class="p-4 mb-5 text-red-700 border border-red-200 bg-red-50">
        <ul class="space-y-1 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form
    action="{{ route('admin.balita.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-5"
>
    @csrf

    <div class="p-5 bg-white border shadow-sm border-slate-200">
        <h3 class="text-lg font-semibold text-slate-800">Data Balita</h3>
        <p class="mt-1 text-sm text-slate-500">
            Lengkapi identitas dasar balita yang akan didaftarkan.
        </p>

        <div class="grid gap-5 mt-5 md:grid-cols-2 xl:grid-cols-3">

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">NIK</label>
                <input
                    type="text"
                    name="nik"
                    value="{{ old('nik') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                @error('nik')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">Nama Balita</label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">Jenis Kelamin</label>
                <select
                    name="jenis_kelamin"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                    <option value="">Pilih</option>
                    <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-Laki</option>
                    <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">Tempat Lahir</label>
                <input
                    type="text"
                    name="tempat_lahir"
                    value="{{ old('tempat_lahir') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                @error('tempat_lahir')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">Tanggal Lahir</label>
                <input
                    type="date"
                    name="tanggal_lahir"
                    value="{{ old('tanggal_lahir') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                @error('tanggal_lahir')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">Berat Lahir (Kg)</label>
                <input
                    type="number"
                    step="0.01"
                    name="berat_lahir"
                    value="{{ old('berat_lahir') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                @error('berat_lahir')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">Tinggi Lahir (Cm)</label>
                <input
                    type="number"
                    step="0.01"
                    name="tinggi_lahir"
                    value="{{ old('tinggi_lahir') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                @error('tinggi_lahir')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 xl:col-span-1">
                <label class="block mb-2 text-sm font-medium text-slate-700">Foto Balita</label>
                <input
                    type="file"
                    name="foto"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition file:mr-3 file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-sm file:font-medium"
                >
                @error('foto')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>

    <div class="p-5 bg-white border shadow-sm border-slate-200">
        <h3 class="text-lg font-semibold text-slate-800">Data Orang Tua</h3>
        <p class="mt-1 text-sm text-slate-500">
            Masukkan data pendamping atau orang tua balita.
        </p>

        <div class="grid gap-5 mt-5 md:grid-cols-2">

            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-slate-700">
                    Akun Orang Tua
                </label>

                <select
                    name="user_id"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                    <option value="">Pilih Akun Orang Tua</option>

                    @foreach($orangTua as $user)
                        <option
                            value="{{ $user->id }}"
                            @selected(old('user_id') == $user->id)
                        >
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>

                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">Nama Ayah</label>
                <input
                    type="text"
                    name="nama_ayah"
                    value="{{ old('nama_ayah') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                @error('nama_ayah')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">Nama Ibu</label>
                <input
                    type="text"
                    name="nama_ibu"
                    value="{{ old('nama_ibu') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                @error('nama_ibu')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">No HP Orang Tua</label>
                <input
                    type="text"
                    name="no_hp_ortu"
                    value="{{ old('no_hp_ortu') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >
                @error('no_hp_ortu')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-slate-700">Alamat</label>
                <textarea
                    name="alamat"
                    rows="4"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]"
                >{{ old('alamat') }}</textarea>

                @error('alamat')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>

    <div class="flex flex-wrap justify-end gap-3">
        <a
            href="{{ route('admin.balita.index') }}"
            class="border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800"
        >
            Kembali
        </a>

        <button
            type="submit"
            class="border border-[#3f37c9] bg-[#3f37c9] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead] hover:shadow focus:outline-none focus:ring-2 focus:ring-[#3f37c9]/20"
        >
            Simpan Data
        </button>
    </div>

</form>
```

</div>
@endsection
