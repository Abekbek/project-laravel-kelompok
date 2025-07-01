<?php
namespace App\Http\Controllers;
use App\Models\TemplateItem;
use App\Models\TierListTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateItemController extends Controller
{
    public function store(Request $request, TierListTemplate $template)
    {
        $this->authorize('update', $template);

        $request->validate([
            'items' => 'required|array',
            'items.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        foreach ($request->file('items') as $file) {
            $path = $file->store('items', 'public');
            $template->items()->create(['image_path' => $path]);
        }

        return back()->with('success', 'Item berhasil ditambahkan!');
    }

    public function destroy(TemplateItem $item)
    {
        $this->authorize('update', $item->template);
        Storage::disk('public')->delete($item->image_path);
        $item->delete();
        return back()->with('success', 'Item berhasil dihapus!');
    }
}
