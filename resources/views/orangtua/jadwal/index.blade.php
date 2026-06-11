@extends('layouts.orangtua')

@section('title', 'Jadwal Posyandu')
@section('page-title', 'Jadwal Posyandu')
@section('page-description', 'Lihat jadwal posyandu yang akan datang.')

@section('content')
<div class="space-y-5">
    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <div>
            <h3 class="text-xl font-semibold text-slate-800">Jadwal Posyandu</h3>
            <p class="mt-1 text-sm text-slate-500">Informasi jadwal layanan posyandu mendatang dapat dilihat di halaman ini.</p>
        </div>
    </div>

    <div class="border border-slate-200 bg-white p-5 shadow-sm">
        <form method="GET" class="flex flex-col gap-3 md:flex-row md:items-center">
            <div class="flex-1">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari judul atau lokasi jadwal..."
                    value="{{ request('search') }}"
                    class="w-full border border-slate-300 px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#3f37c9]"
                >
            </div>
            <div class="flex gap-2">
                <button type="submit" class="border border-[#3f37c9] px-4 py-2.5 text-sm font-medium text-[#3f37c9] transition hover:bg-[#3f37c9] hover:text-white">
                    Cari
                </button>
                @if (request()->filled('search'))
                    <a href="{{ route('orangtua.jadwal.index') }}" class="border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-[980px] w-full table-fixed border-collapse">
                <thead class="bg-slate-50">
                    <tr class="border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Judul</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Jam</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Lokasi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($jadwals as $item)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-4 py-4 text-sm text-slate-500">{{ $jadwals->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-4 text-sm font-medium text-slate-800">{{ $item->judul }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ optional($item->tanggal)->format('d M Y') }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $item->lokasi }}</td>
                            <td class="px-4 py-4 text-sm">
                                <a href="{{ route('orangtua.jadwal.show', $item) }}" class="inline-flex min-w-[80px] items-center justify-center border border-sky-600 px-3 py-2 text-xs font-medium text-sky-600 transition hover:bg-sky-600 hover:text-white">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">
                                Belum ada jadwal posyandu yang tersedia.
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
@endsection
