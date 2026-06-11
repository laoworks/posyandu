<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPosyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $jadwals = JadwalPosyandu::when(
            $search,
            function ($query) use ($search) {

                $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            }
        )
            ->latest()
            ->paginate(10);

        return view(
            'admin.jadwal.index',
            compact('jadwals')
        );
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'required|max:255',
            'keterangan' => 'nullable'
        ]);

        $validated['created_by'] = Auth::id();

        JadwalPosyandu::create($validated);

        return redirect()
            ->route('admin.jadwal-posyandu.index')
            ->with(
                'success',
                'Jadwal berhasil ditambahkan'
            );
    }

    public function show(JadwalPosyandu $jadwalPosyandu)
    {
        return view(
            'admin.jadwal.show',
            compact('jadwalPosyandu')
        );
    }

    public function edit(JadwalPosyandu $jadwalPosyandu)
    {
        return view(
            'admin.jadwal.edit',
            compact('jadwalPosyandu')
        );
    }

    public function update(
        Request $request,
        JadwalPosyandu $jadwalPosyandu
    ) {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'required|max:255',
            'keterangan' => 'nullable'
        ]);

        $jadwalPosyandu->update($validated);

        return redirect()
            ->route('admin.jadwal-posyandu.index')
            ->with(
                'success',
                'Jadwal berhasil diperbarui'
            );
    }

    public function destroy(
        JadwalPosyandu $jadwalPosyandu
    ) {
        $jadwalPosyandu->delete();

        return redirect()
            ->route('admin.jadwal-posyandu.index')
            ->with(
                'success',
                'Jadwal berhasil dihapus'
            );
    }
}
