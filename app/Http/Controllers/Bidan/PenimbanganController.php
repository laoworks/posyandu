<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\BayiBalita;
use App\Models\Penimbangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenimbanganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $penimbangans = Penimbangan::with('bayi')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('bayi', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view(
            'bidan.penimbangan.index',
            compact('penimbangans')
        );
    }

    public function create()
    {
        $balitas = BayiBalita::orderBy('nama')->get();

        return view(
            'bidan.penimbangan.create',
            compact('balitas')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bayi_balita_id' => 'required|exists:bayi_balita,id',
            'tanggal' => 'required|date',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
            'lingkar_kepala' => 'nullable|numeric|min:0',
            'lingkar_lengan' => 'nullable|numeric|min:0',
            'catatan' => 'nullable'
        ]);

        $validated['user_id'] = Auth::id();

        Penimbangan::create($validated);

        return redirect()
            ->route('bidan.penimbangan.index')
            ->with(
                'success',
                'Data penimbangan berhasil ditambahkan'
            );
    }

    public function show(Penimbangan $penimbangan)
    {
        $penimbangan->load('bayi');

        return view(
            'bidan.penimbangan.show',
            compact('penimbangan')
        );
    }

    public function edit(Penimbangan $penimbangan)
    {
        $balitas = BayiBalita::orderBy('nama')->get();

        return view(
            'bidan.penimbangan.edit',
            compact(
                'penimbangan',
                'balitas'
            )
        );
    }

    public function update(
        Request $request,
        Penimbangan $penimbangan
    ) {
        $validated = $request->validate([
            'bayi_balita_id' => 'required|exists:bayi_balita,id',
            'tanggal' => 'required|date',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
            'lingkar_kepala' => 'nullable|numeric|min:0',
            'lingkar_lengan' => 'nullable|numeric|min:0',
            'catatan' => 'nullable'
        ]);

        $penimbangan->update($validated);

        return redirect()
            ->route('bidan.penimbangan.index')
            ->with(
                'success',
                'Data penimbangan berhasil diperbarui'
            );
    }

    public function destroy(Penimbangan $penimbangan)
    {
        $penimbangan->delete();

        return redirect()
            ->route('bidan.penimbangan.index')
            ->with(
                'success',
                'Data penimbangan berhasil dihapus'
            );
    }
}

