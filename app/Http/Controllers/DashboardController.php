<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the user's dashboard.
     */
    public function index(): View
    {
        // Ambil template milik user yang sedang login
        $myTemplates = Auth::user()->templates()->latest()->get();

        // Kirim data template tersebut ke view 'dashboard'
        return view('dashboard', [
            'myTemplates' => $myTemplates
        ]);
    }
}
