@extends('layouts.bidan')

@section('title', 'Tambah Penimbangan')
@section('page-title', 'Tambah Penimbangan')
@section('page-description', 'Input hasil penimbangan balita secara ringkas dan terstruktur.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div>
            <h3 class="text-xl font-semibold text-slate-800">Form Penimbangan</h3>
            <p class="mt-1 text-sm text-slate-500">Lengkapi data pengukuran balita pada kunjungan posyandu.</p>
        </div>
    </div>

    <form action="{{ route('bidan.penimbangan.store') }}" method="POST" class="border border-slate-200 bg-white p-5 shadow-sm">
        @csrf

        @if ($balitas->isEmpty())
            <div class="mb-5 border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                Data balita belum tersedia, jadi pilihan `Nama Balita` belum bisa ditampilkan.
                Silakan tambahkan data terlebih dahulu di
                <a href="{{ route('bidan.balita.index') }}" class="font-medium text-[#3f37c9] underline">
                    Data Balita
                </a>.
            </div>
        @endif

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="bayi_balita_id" class="mb-2 block text-sm font-medium text-slate-700">Nama Balita</label>
                <select id="bayi_balita_id" name="bayi_balita_id" @disabled($balitas->isEmpty()) class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9] disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-400">
                    <option value="">{{ $balitas->isEmpty() ? 'Belum ada data balita' : 'Pilih balita' }}</option>
                    @foreach ($balitas as $balita)
                        <option value="{{ $balita->id }}" @selected(old('bayi_balita_id') == $balita->id)>
                            {{ $balita->nama }} - {{ $balita->nik }}
                        </option>
                    @endforeach
                </select>
                @error('bayi_balita_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal" class="mb-2 block text-sm font-medium text-slate-700">Tanggal Penimbangan</label>
                <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('tanggal')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="berat_badan" class="mb-2 block text-sm font-medium text-slate-700">Berat Badan (Kg)</label>
                <input id="berat_badan" type="number" step="0.01" min="0" name="berat_badan" value="{{ old('berat_badan') }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('berat_badan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tinggi_badan" class="mb-2 block text-sm font-medium text-slate-700">Tinggi Badan (Cm)</label>
                <input id="tinggi_badan" type="number" step="0.01" min="0" name="tinggi_badan" value="{{ old('tinggi_badan') }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('tinggi_badan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lingkar_kepala" class="mb-2 block text-sm font-medium text-slate-700">Lingkar Kepala (Cm)</label>
                <input id="lingkar_kepala" type="number" step="0.01" min="0" name="lingkar_kepala" value="{{ old('lingkar_kepala') }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('lingkar_kepala')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lingkar_lengan" class="mb-2 block text-sm font-medium text-slate-700">Lingkar Lengan (Cm)</label>
                <input id="lingkar_lengan" type="number" step="0.01" min="0" name="lingkar_lengan" value="{{ old('lingkar_lengan') }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">
                @error('lingkar_lengan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-5">
            <label for="catatan" class="mb-2 block text-sm font-medium text-slate-700">Catatan</label>
            <textarea id="catatan" name="catatan" rows="4" class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]">{{ old('catatan') }}</textarea>
            @error('catatan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ route('bidan.penimbangan.index') }}" class="border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                Kembali
            </a>
            <button type="submit" @disabled($balitas->isEmpty()) class="border border-[#3f37c9] bg-[#3f37c9] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead] hover:shadow focus:outline-none focus:ring-2 focus:ring-[#3f37c9]/20 disabled:cursor-not-allowed disabled:border-slate-300 disabled:bg-slate-300 disabled:text-white disabled:shadow-none">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection

