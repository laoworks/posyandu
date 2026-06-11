<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\Penimbangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PenimbanganController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->search;

        $penimbangans = Penimbangan::with('bayi')
            ->whereHas('bayi', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('bayi', function ($childQuery) use ($search) {
                    $childQuery->where('nama', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('orangtua.penimbangan.index', compact('penimbangans'));
    }

    public function show(Penimbangan $penimbangan): View
    {
        $penimbangan->load('bayi');

        abort_unless($penimbangan->bayi?->user_id === Auth::id(), 404);

        return view('orangtua.penimbangan.show', compact('penimbangan'));
    }
}
