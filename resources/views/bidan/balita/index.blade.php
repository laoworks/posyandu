@extends('layouts.bidan')

@section('title', 'Data Balita')
@section('page-title', 'Data Balita')
@section('page-description', 'Kelola data balita dengan tampilan tabel yang lebih ringkas dan mudah dibaca.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">Manajemen Data Balita</h3>
                <p class="mt-1 text-sm text-slate-500">Daftar data balita yang sudah terdaftar di sistem posyandu.</p>
            </div>

            <a
                href="{{ route('bidan.balita.create') }}"
                class="inline-flex items-center justify-center border border-[#3f37c9] px-4 py-2.5 text-sm font-medium text-[#3f37c9] transition hover:bg-[#3f37c9] hover:text-white"
            >
                Tambah Balita
            </a>
        </div>
    </div>

    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <form method="GET" class="flex flex-col gap-3 md:flex-row md:items-center">
            <div class="flex-1">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama atau NIK..."
                    value="{{ request('search') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]"
                >
            </div>

            <div class="flex gap-2">
                <button
                    type="submit"
                    class="border border-[#3f37c9] px-4 py-2.5 text-sm font-medium text-[#3f37c9] transition hover:bg-[#3f37c9] hover:text-white"
                >
                    Cari
                </button>

                @if (request()->filled('search'))
                    <a
                        href="{{ route('bidan.balita.index') }}"
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
            <table class="min-w-[1080px] w-full table-fixed border-collapse">
                <colgroup>
                    <col class="w-[6%]">
                    <col class="w-[8%]">
                    <col class="w-[18%]">
                    <col class="w-[20%]">
                    <col class="w-[8%]">
                    <col class="w-[14%]">
                    <col class="w-[26%]">
                </colgroup>
                <thead class="bg-slate-50">
                    <tr class="border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Foto</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">NIK</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">JK</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal Lahir</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($balitas as $balita)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-4 py-4 text-sm text-slate-500">
                                {{ $balitas->firstItem() + $loop->index }}
                            </td>
                            <td class="px-4 py-4">
                                <img
                                    src="{{ $balita->foto ? asset('storage/'.$balita->foto) : 'https://ui-avatars.com/api/?name='.urlencode($balita->nama).'&background=EEF2FF&color=3f37c9' }}"
                                    alt="{{ $balita->nama }}"
                                    class="h-11 w-11 object-cover"
                                >
                            </td>
                            <td class="px-4 py-4 text-sm text-slate-600 break-words">{{ $balita->nik }}</td>
                            <td class="px-4 py-4 text-sm font-medium text-slate-800 break-words">{{ $balita->nama }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $balita->jenis_kelamin }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">
                                {{ \Carbon\Carbon::parse($balita->tanggal_lahir)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                <div class="flex flex-nowrap items-center gap-2">
                                    <a
                                        href="{{ route('bidan.balita.show', $balita) }}"
                                        class="inline-flex min-w-[72px] items-center justify-center border border-sky-600 px-3 py-2 text-xs font-medium text-sky-600 transition hover:bg-sky-600 hover:text-white"
                                    >
                                        Detail
                                    </a>
                                    <a
                                        href="{{ route('bidan.balita.edit', $balita) }}"
                                        class="inline-flex min-w-[72px] items-center justify-center border border-amber-500 px-3 py-2 text-xs font-medium text-amber-600 transition hover:bg-amber-500 hover:text-white"
                                    >
                                        Edit
                                    </a>
                                    <form
                                        action="{{ route('bidan.balita.destroy', $balita) }}"
                                        method="POST"
                                        class="delete-balita-form inline-flex"
                                        data-nama="{{ $balita->nama }}"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex min-w-[72px] items-center justify-center border border-red-600 px-3 py-2 text-xs font-medium text-red-600 transition hover:bg-red-600 hover:text-white"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center text-sm text-slate-500">
                                Data balita belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="border border-slate-200 bg-white px-5 py-4 shadow-sm">
        {{ $balitas->links() }}
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
    document.querySelectorAll('.delete-balita-form').forEach((form) => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Hapus data balita?',
                text: `Data ${this.dataset.nama} akan dihapus permanen.`,
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

