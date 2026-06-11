@extends('layouts.bidan')

@section('title', 'Data Imunisasi')
@section('page-title', 'Data Imunisasi')
@section('page-description', 'Kelola riwayat imunisasi balita dengan tampilan tabel yang ringkas dan mudah dibaca.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">Manajemen Imunisasi</h3>
                <p class="mt-1 text-sm text-slate-500">Daftar pelayanan imunisasi balita yang telah tercatat di sistem.</p>
            </div>

            <a
                href="{{ route('bidan.imunisasi.create') }}"
                class="inline-flex items-center justify-center border border-[#3f37c9] px-4 py-2.5 text-sm font-medium text-[#3f37c9] transition hover:bg-[#3f37c9] hover:text-white"
            >
                Tambah Imunisasi
            </a>
        </div>
    </div>

    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <form method="GET" class="flex flex-col gap-3 md:flex-row md:items-center">
            <div class="flex-1">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama balita..."
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
                        href="{{ route('bidan.imunisasi.index') }}"
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
            <table class="min-w-[1060px] w-full table-fixed border-collapse">
                <colgroup>
                    <col class="w-[6%]">
                    <col class="w-[20%]">
                    <col class="w-[12%]">
                    <col class="w-[18%]">
                    <col class="w-[14%]">
                    <col class="w-[18%]">
                    <col class="w-[12%]">
                </colgroup>
                <thead class="bg-slate-50">
                    <tr class="border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Balita</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Jenis Imunisasi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Dosis</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Keterangan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($imunisasis as $imunisasi)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-4 py-4 text-sm text-slate-500">{{ $imunisasis->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-4 text-sm font-medium text-slate-800 break-words">{{ $imunisasi->bayi?->nama ?? '-' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ optional($imunisasi->tanggal)->format('d M Y') }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600 break-words">{{ $imunisasi->jenis_imunisasi }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600 break-words">{{ $imunisasi->dosis ?: '-' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600 break-words">{{ $imunisasi->keterangan ?: '-' }}</td>
                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                <div class="flex flex-nowrap items-center gap-2">
                                    <a href="{{ route('bidan.imunisasi.show', $imunisasi) }}" class="inline-flex min-w-[72px] items-center justify-center border border-sky-600 px-3 py-2 text-xs font-medium text-sky-600 transition hover:bg-sky-600 hover:text-white">
                                        Detail
                                    </a>
                                    <a href="{{ route('bidan.imunisasi.edit', $imunisasi) }}" class="inline-flex min-w-[72px] items-center justify-center border border-amber-500 px-3 py-2 text-xs font-medium text-amber-600 transition hover:bg-amber-500 hover:text-white">
                                        Edit
                                    </a>
                                    <form action="{{ route('bidan.imunisasi.destroy', $imunisasi) }}" method="POST" class="delete-imunisasi-form inline-flex" data-nama="{{ $imunisasi->bayi?->nama ?? 'data ini' }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex min-w-[72px] items-center justify-center border border-red-600 px-3 py-2 text-xs font-medium text-red-600 transition hover:bg-red-600 hover:text-white">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center text-sm text-slate-500">
                                Data imunisasi belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="border border-slate-200 bg-white px-5 py-4 shadow-sm">
        {{ $imunisasis->links() }}
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
    document.querySelectorAll('.delete-imunisasi-form').forEach((form) => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Hapus data imunisasi?',
                text: `Data imunisasi untuk ${this.dataset.nama} akan dihapus.`,
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

