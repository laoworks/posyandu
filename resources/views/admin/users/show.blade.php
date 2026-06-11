@extends('layouts.admin')

@php
    $roleLabels = [
        'kader' => 'Kader Posyandu',
        'bidan_desa' => 'Bidan Desa',
        'orang_tua' => 'Orang Tua',
    ];
@endphp

@section('title', 'Detail User')
@section('page-title', 'Detail User')
@section('page-description', 'Lihat informasi akun dan role akses pengguna.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-5 md:flex-row md:items-start md:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">{{ $user->name }}</h3>
                <p class="mt-1 text-sm text-slate-500">{{ $user->email }}</p>
                <p class="mt-1 text-sm text-slate-500">{{ $roleLabels[$user->roles->first()?->name] ?? '-' }}</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex min-w-[108px] items-center justify-center border border-amber-500 px-4 py-2.5 text-sm font-medium text-amber-600 transition hover:bg-amber-500 hover:text-white">
                    Edit User
                </a>
                <a href="{{ route('admin.users.index') }}" class="inline-flex min-w-[108px] items-center justify-center border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid gap-5 xl:grid-cols-2">
        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-800">Informasi Akun</h3>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Nama</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $user->name }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Email</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $user->email }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Role</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $roleLabels[$user->roles->first()?->name] ?? '-' }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Tanggal Dibuat</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $user->created_at?->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-800">Ringkasan Relasi</h3>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Total Anak Terhubung</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">{{ $user->anak->count() }}</p>
                </div>
                <div class="border border-slate-200 p-4">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Status Akun</p>
                    <p class="mt-2 text-sm font-medium text-slate-800">Aktif</p>
                </div>
            </div>

            <div class="mt-4 border border-slate-200 p-4">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Catatan</p>
                <p class="mt-2 text-sm leading-6 text-slate-700">
                    Untuk role orang tua, jumlah anak terhubung akan mengikuti data balita yang memakai `user_id` akun ini.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
