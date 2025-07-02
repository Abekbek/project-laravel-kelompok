<?php
namespace App\Http\Controllers;
use App\Models\TierListTemplate;
use App\Models\UserTierList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    public function show(TierListTemplate $template)
    {
        $template->load('tierRows', 'items');
        return view('ranking.show', compact('template'));
    }

    public function store(Request $request, TierListTemplate $template)
    {
        $request->validate(['ranking_data' => 'required|json']);
        UserTierList::updateOrCreate(
            ['user_id' => Auth::id(), 'tier_list_template_id' => $template->id],
            ['ranking_data' => $request->ranking_data]
        );
        return response()->json(['success' => true, 'message' => 'Ranking berhasil disimpan!']);
    }
}
