<?php

namespace App\Http\Controllers\Admin;

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

        $balitas = BayiBalita::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.balita.index', compact('balitas'));
    }

    public function create()
    {
        $orangTua = User::role('orang_tua')
            ->orderBy('name')
            ->get();

        return view('admin.balita.create', compact('orangTua'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:bayi_balita,nik',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'berat_lahir' => 'nullable|numeric',
            'tinggi_lahir' => 'nullable|numeric',

            'user_id' => 'required|exists:users,id',

            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'no_hp_ortu' => 'nullable',
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
            ->route('admin.balita.index')
            ->with('success', 'Data balita berhasil ditambahkan');
    }

    public function show(BayiBalita $balitum)
    {
        return view('admin.balita.show', compact('balitum'));
    }

    public function edit(BayiBalita $balitum)
    {
        $orangTua = User::role('orang_tua')
            ->orderBy('name')
            ->get();

        return view('admin.balita.edit', [
            'balitum' => $balitum,
            'orangTua' => $orangTua,
        ]);
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
            ->route('admin.balita.index')
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
