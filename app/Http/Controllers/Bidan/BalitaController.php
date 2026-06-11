<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\BayiBalita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BalitaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $balitas = BayiBalita::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('bidan.balita.index', compact('balitas'));
    }

    public function create()
    {
        return view('bidan.balita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:bayi_balita',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'berat_lahir' => 'nullable|numeric',
            'tinggi_lahir' => 'nullable|numeric',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'no_hp_ortu' => 'nullable',
            'alamat' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request
                ->file('foto')
                ->store('balita', 'public');
        }

        BayiBalita::create($validated);

        return redirect()
            ->route('bidan.balita.index')
            ->with('success', 'Data balita berhasil ditambahkan');
    }

    public function show(BayiBalita $balitum)
    {
        return view('bidan.balita.show', compact('balitum'));
    }

    public function edit(BayiBalita $balitum)
    {
        return view('bidan.balita.edit', compact('balitum'));
    }

    public function update(Request $request, BayiBalita $balitum)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:bayi_balita,nik,' . $balitum->id,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'berat_lahir' => 'nullable|numeric',
            'tinggi_lahir' => 'nullable|numeric',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'no_hp_ortu' => 'nullable',
            'alamat' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {

            if ($balitum->foto) {
                Storage::disk('public')->delete($balitum->foto);
            }

            $validated['foto'] = $request
                ->file('foto')
                ->store('balita', 'public');
        }

        $balitum->update($validated);

        return redirect()
            ->route('bidan.balita.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(BayiBalita $balitum)
    {
        if ($balitum->foto) {
            Storage::disk('public')->delete($balitum->foto);
        }

        $balitum->delete();

        return back()
            ->with('success', 'Data berhasil dihapus');
    }
}

