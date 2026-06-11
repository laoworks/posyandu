<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\BayiBalita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BalitaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $balitas = BayiBalita::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('bidan.balita.index', compact('balitas'));
    }

    public function create()
    {
        $orangTua = User::orderBy('name')->get();

        return view('bidan.balita.create', compact('orangTua'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',

            'nik' => 'required|unique:bayi_balita,nik',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',

            'berat_lahir' => 'nullable|numeric',
            'tinggi_lahir' => 'nullable|numeric',

            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'no_hp_ortu' => 'nullable|string|max:20',

            'alamat' => 'required',

            'foto' => 'nullable|image|max:2048',
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
        $balitum->load('user');

        return view('bidan.balita.show', compact('balitum'));
    }

    public function edit(BayiBalita $balitum)
    {
        $orangTua = User::orderBy('name')->get();

        return view('bidan.balita.edit', compact(
            'balitum',
            'orangTua'
        ));
    }

    public function update(Request $request, BayiBalita $balitum)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',

            'nik' => 'required|unique:bayi_balita,nik,' . $balitum->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',

            'berat_lahir' => 'nullable|numeric',
            'tinggi_lahir' => 'nullable|numeric',

            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'no_hp_ortu' => 'nullable|string|max:20',

            'alamat' => 'required',

            'foto' => 'nullable|image|max:2048',
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

        return back()->with(
            'success',
            'Data berhasil dihapus'
        );
    }
}
