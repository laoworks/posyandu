@extends('layouts.admin')

@php
    $roleLabels = [
        'kader' => 'Kader Posyandu',
        'bidan_desa' => 'Bidan Desa',
        'orang_tua' => 'Orang Tua',
    ];
@endphp

@section('title', 'Tambah User')
@section('page-title', 'Tambah User')
@section('page-description', 'Buat akun baru dan tentukan role aksesnya.')

@section('content')
<div class="max-w-5xl">
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
        @csrf

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-800">Informasi User</h3>
            <p class="mt-1 text-sm text-slate-500">Masukkan identitas akun dan role akses pengguna.</p>

            <div class="mt-5 grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Role Akses</label>
                    <select name="role" class="w-full border border-slate-300 px-4 py-2.5 text-sm outline-none transition focus:border-[#3f37c9]">
                        <option value="">Pilih role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected(old('role') === $role->name)>
                                {{ $roleLabels[$role->name] ?? $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex flex-wrap justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                Kembali
            </a>
            <button type="submit" class="border border-[#3f37c9] bg-[#3f37c9] px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead] hover:shadow focus:outline-none focus:ring-2 focus:ring-[#3f37c9]/20">
                Simpan User
            </button>
        </div>
    </form>
</div>
@endsection
