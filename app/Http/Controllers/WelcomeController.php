<?php
namespace App\Http\Controllers;

use App\Models\TierListTemplate;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $popularTemplates = TierListTemplate::with('user')
                                ->latest() // Mengambil yang terbaru
                                ->take(10)   // Batasi 10 template
                                ->get();

        return view('welcome', compact('popularTemplates'));
    }
}