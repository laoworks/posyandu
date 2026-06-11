<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $dashboardRoute = $user?->dashboardRouteName();

        if ($dashboardRoute !== null) {
            return redirect()->route($dashboardRoute);
        }

        abort(403);
    }
}
