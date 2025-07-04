<?php
namespace App\Http\Controllers;

use App\Models\TierListTemplate;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $results = TierListTemplate::with('user')
                        ->where('title', 'like', "%{$query}%")
                        ->latest()
                        ->paginate(20);

        return view('search.results', [
            'results' => $results,
            'query'   => $query,
        ]);
    }
}