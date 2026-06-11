<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\BayiBalita;
use App\Models\Imunisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImunisasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $imunisasis = Imunisasi::with('bayi')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('bayi', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view(
            'bidan.imunisasi.index',
            compact('imunisasis')
        );
    }

    public function create()
    {
        $balitas = BayiBalita::orderBy('nama')->get();

        return view(
            'bidan.imunisasi.create',
            compact('balitas')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bayi_balita_id' => 'required|exists:bayi_balita,id',
            'tanggal' => 'required|date',
            'jenis_imunisasi' => 'required',
            'dosis' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        $validated['user_id'] = Auth::id();

        Imunisasi::create($validated);

        return redirect()
            ->route('bidan.imunisasi.index')
            ->with(
                'success',
                'Data imunisasi berhasil ditambahkan'
            );
    }

    public function show(Imunisasi $imunisasi)
    {
        $imunisasi->load('bayi');

        return view(
            'bidan.imunisasi.show',
            compact('imunisasi')
        );
    }

    public function edit(Imunisasi $imunisasi)
    {
        $balitas = BayiBalita::orderBy('nama')->get();

        return view(
            'bidan.imunisasi.edit',
            compact(
                'imunisasi',
                'balitas'
            )
        );
    }

    public function update(
        Request $request,
        Imunisasi $imunisasi
    ) {
        $validated = $request->validate([
            'bayi_balita_id' => 'required|exists:bayi_balita,id',
            'tanggal' => 'required|date',
            'jenis_imunisasi' => 'required',
            'dosis' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        $imunisasi->update($validated);

        return redirect()
            ->route('bidan.imunisasi.index')
            ->with(
                'success',
                'Data imunisasi berhasil diperbarui'
            );
    }

    public function destroy(Imunisasi $imunisasi)
    {
        $imunisasi->delete();

        return redirect()
            ->route('bidan.imunisasi.index')
            ->with(
                'success',
                'Data imunisasi berhasil dihapus'
            );
    }
}

