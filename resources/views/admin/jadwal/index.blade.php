@extends('layouts.admin')

@section('title', 'Jadwal Posyandu')
@section('page-title', 'Jadwal Posyandu')
@section('page-description', 'Kelola jadwal kegiatan posyandu dengan tampilan yang ringkas dan mudah dipantau.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h3 class="text-xl font-semibold text-slate-800">Manajemen Jadwal Posyandu</h3>
                <p class="mt-1 text-sm text-slate-500">Susun jadwal pelayanan posyandu agar kegiatan lebih teratur dan mudah diakses.</p>
            </div>

            <a
                href="{{ route('admin.jadwal-posyandu.create') }}"
                class="inline-flex items-center justify-center border border-[#3f37c9] px-4 py-2.5 text-sm font-medium text-[#3f37c9] transition hover:bg-[#3f37c9] hover:text-white"
            >
                Tambah Jadwal
            </a>
        </div>
    </div>

    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <form method="GET" class="flex flex-col gap-3 md:flex-row md:items-center">
            <div class="flex-1">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari judul atau lokasi..."
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
                        href="{{ route('admin.jadwal-posyandu.index') }}"
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
                    <col class="w-[24%]">
                    <col class="w-[12%]">
                    <col class="w-[12%]">
                    <col class="w-[18%]">
                    <col class="w-[16%]">
                    <col class="w-[12%]">
                </colgroup>
                <thead class="bg-slate-50">
                    <tr class="border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Judul</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Jam</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Lokasi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Keterangan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($jadwals as $jadwal)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-4 py-4 text-sm text-slate-500">{{ $jadwals->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-4 text-sm font-medium text-slate-800 break-words">{{ $jadwal->judul }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ optional($jadwal->tanggal)->format('d M Y') }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600 break-words">{{ $jadwal->lokasi }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600 break-words">{{ $jadwal->keterangan ?: '-' }}</td>
                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                <div class="flex flex-nowrap items-center gap-2">
                                    <a href="{{ route('admin.jadwal-posyandu.show', $jadwal) }}" class="inline-flex min-w-[72px] items-center justify-center border border-sky-600 px-3 py-2 text-xs font-medium text-sky-600 transition hover:bg-sky-600 hover:text-white">
                                        Detail
                                    </a>
                                    <a href="{{ route('admin.jadwal-posyandu.edit', $jadwal) }}" class="inline-flex min-w-[72px] items-center justify-center border border-amber-500 px-3 py-2 text-xs font-medium text-amber-600 transition hover:bg-amber-500 hover:text-white">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.jadwal-posyandu.destroy', $jadwal) }}" method="POST" class="delete-jadwal-form inline-flex" data-judul="{{ $jadwal->judul }}">
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
                                Jadwal posyandu belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="border border-slate-200 bg-white px-5 py-4 shadow-sm">
        {{ $jadwals->links() }}
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
    document.querySelectorAll('.delete-jadwal-form').forEach((form) => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Hapus jadwal posyandu?',
                text: `Jadwal "${this.dataset.judul}" akan dihapus.`,
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
