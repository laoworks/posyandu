<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\BayiBalita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AnakController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->search;

        $anak = BayiBalita::where('user_id', Auth::id())
            ->when($search, function ($query) use ($search) {
                $query->where(function ($childQuery) use ($search) {
                    $childQuery->where('nama', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('orangtua.anak.index', compact('anak'));
    }

    public function show(BayiBalita $anak): View
    {
        abort_unless($anak->user_id === Auth::id(), 404);

        $anak->load([
            'penimbangan' => fn($query) => $query->latest()->take(5),
            'imunisasi' => fn($query) => $query->latest()->take(5),
        ]);

        return view('orangtua.anak.show', compact('anak'));
    }
}
