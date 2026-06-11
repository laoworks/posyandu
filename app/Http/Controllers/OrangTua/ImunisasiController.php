<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\Imunisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ImunisasiController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->search;

        $imunisasis = Imunisasi::with('bayi')
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

        return view('orangtua.imunisasi.index', compact('imunisasis'));
    }

    public function show(Imunisasi $imunisasi): View
    {
        $imunisasi->load('bayi');

        abort_unless($imunisasi->bayi?->user_id === Auth::id(), 404);

        return view('orangtua.imunisasi.show', compact('imunisasi'));
    }
}
