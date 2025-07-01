<?php
namespace App\Http\Controllers;
use App\Models\TierListTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TierListTemplateController extends Controller
{
    public function create() { return view('templates.create'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tiers' => 'required|string',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image_path'] = $request->file('cover_image')->store('covers', 'public');
        }

        // Hapus key 'cover_image' karena tidak ada kolomnya di database
        unset($validated['tiers']);
        unset($validated['cover_image']);

        $template = Auth::user()->templates()->create($validated);

        $tierLabels = explode(',', $request->tiers);
        $tierColors = ['#ef4444', '#f97316', '#eab308', '#22c55e', '#3b82f6', '#8b5cf6'];
        foreach ($tierLabels as $index => $label) {
            if (trim($label) !== '') {
                $template->tierRows()->create(['label' => trim($label), 'order' => $index, 'color' => $tierColors[$index % count($tierColors)]]);
            }
        }
        return redirect()->route('dashboard')->with('success', 'Template berhasil dibuat!');
    }

    public function edit(TierListTemplate $template) {
        $this->authorize('update', $template);
        return view('templates.edit', compact('template'));
    }

    public function update(Request $request, TierListTemplate $template)
    {
        $this->authorize('update', $template);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            if ($template->cover_image_path) {
                Storage::disk('public')->delete($template->cover_image_path);
            }
            $validated['cover_image_path'] = $request->file('cover_image')->store('covers', 'public');
        }

        // Hapus key 'cover_image' karena tidak ada kolomnya di database
        unset($validated['cover_image']);

        $template->update($validated);
        return redirect()->route('dashboard')->with('success', 'Template berhasil diperbarui!');
    }

    public function destroy(TierListTemplate $template) {
        $this->authorize('delete', $template);
        $template->delete();
        return redirect()->route('dashboard')->with('success', 'Template berhasil dihapus!');
    }
}
