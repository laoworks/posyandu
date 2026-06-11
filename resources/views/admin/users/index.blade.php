@extends('layouts.admin')

@php
    $roleLabels = [
        'kader' => 'Kader Posyandu',
        'bidan_desa' => 'Bidan Desa',
        'orang_tua' => 'Orang Tua',
    ];
@endphp

@section('title', 'Data User')
@section('page-title', 'Data User')
@section('page-description', 'Kelola akun pengguna dan role akses sesuai alur posyandu.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">Manajemen Data User</h3>
                <p class="mt-1 text-sm text-slate-500">Kelola akun kader, bidan desa, dan orang tua dari satu halaman.</p>
            </div>

            <a
                href="{{ route('admin.users.create') }}"
                class="inline-flex items-center justify-center border border-[#3f37c9] px-4 py-2.5 text-sm font-medium text-[#3f37c9] transition hover:bg-[#3f37c9] hover:text-white"
            >
                Tambah User
            </a>
        </div>
    </div>

    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <form method="GET" class="grid gap-3 lg:grid-cols-[1fr_220px_auto]">
            <input
                type="text"
                name="search"
                placeholder="Cari nama atau email..."
                value="{{ request('search') }}"
                class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]"
            >

            <select
                name="role"
                class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]"
            >
                <option value="">Semua Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" @selected(request('role') === $role->name)>
                        {{ $roleLabels[$role->name] ?? $role->name }}
                    </option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <button
                    type="submit"
                    class="border border-[#3f37c9] px-4 py-2.5 text-sm font-medium text-[#3f37c9] transition hover:bg-[#3f37c9] hover:text-white"
                >
                    Filter
                </button>
                @if (request()->filled('search') || request()->filled('role'))
                    <a
                        href="{{ route('admin.users.index') }}"
                        class="border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800"
                    >
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-[980px] w-full table-fixed border-collapse">
                <colgroup>
                    <col class="w-[7%]">
                    <col class="w-[21%]">
                    <col class="w-[25%]">
                    <col class="w-[17%]">
                    <col class="w-[10%]">
                    <col class="w-[20%]">
                </colgroup>
                <thead class="bg-slate-50">
                    <tr class="border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Role</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Anak</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($users as $item)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-4 py-4 text-sm text-slate-500">{{ $users->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-4 text-sm font-medium text-slate-800 break-words">{{ $item->name }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600 break-words">{{ $item->email }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $roleLabels[$item->roles->first()?->name] ?? '-' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $item->anak_count }}</td>
                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                <div class="flex flex-nowrap items-center gap-2">
                                    <a href="{{ route('admin.users.show', $item) }}" class="inline-flex min-w-[72px] items-center justify-center border border-sky-600 px-3 py-2 text-xs font-medium text-sky-600 transition hover:bg-sky-600 hover:text-white">
                                        Detail
                                    </a>
                                    <a href="{{ route('admin.users.edit', $item) }}" class="inline-flex min-w-[72px] items-center justify-center border border-amber-500 px-3 py-2 text-xs font-medium text-amber-600 transition hover:bg-amber-500 hover:text-white">
                                        Edit
                                    </a>
                                    <form
                                        action="{{ route('admin.users.destroy', $item) }}"
                                        method="POST"
                                        class="delete-user-form inline-flex"
                                        data-nama="{{ $item->name }}"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="inline-flex min-w-[72px] items-center justify-center border border-red-600 px-3 py-2 text-xs font-medium text-red-600 transition hover:bg-red-600 hover:text-white"
                                            @disabled((int) $item->id === (int) auth()->id())
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">
                                Data user belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="border border-slate-200 bg-white px-5 py-4 shadow-sm">
        {{ $users->links() }}
    </div>
</div>

@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: @json(session('success')),
            confirmButtonColor: '#3f37c9',
        });
    </script>
@else
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endif

<script>
    document.querySelectorAll('.delete-user-form').forEach((form) => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Hapus data user?',
                text: `Akun ${this.dataset.nama} akan dihapus dari sistem.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection
