<?php
// app/Http/Controllers/Backend/AdController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ads\StoreAdRequest;
use App\Http\Requests\Ads\UpdateAdRequest;
use App\Models\Ad;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdController extends Controller
{
    public function index(Request $request): View
    {
        $ads = Ad::query()
            ->when($request->filled('slot'), fn ($q) => $q->where('slot', $request->slot))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('search'), fn ($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('backend.ads.index', compact('ads'));
    }

    public function create(): View
    {
        return view('backend.ads.create', ['ad' => new Ad()]);
    }

    public function store(StoreAdRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('ads', 'public');
        }

        $data['open_new_tab'] = $request->boolean('open_new_tab');

        Ad::create($data);

        return redirect()
            ->route('backend.ads.index')
            ->with('success', 'Ad created successfully.');
    }

    public function edit(Ad $ad): View
    {
        return view('backend.ads.edit', compact('ad'));
    }

    public function update(UpdateAdRequest $request, Ad $ad): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($ad->image_path) {
                Storage::disk('public')->delete($ad->image_path);
            }
            $data['image_path'] = $request->file('image')->store('ads', 'public');
        }

        $data['open_new_tab'] = $request->boolean('open_new_tab');

        $ad->update($data);

        return redirect()
            ->route('backend.ads.index')
            ->with('success', 'Ad updated successfully.');
    }

    public function destroy(Ad $ad): RedirectResponse
    {
        if ($ad->image_path) {
            Storage::disk('public')->delete($ad->image_path);
        }

        $ad->delete();

        return redirect()
            ->route('backend.ads.index')
            ->with('success', 'Ad deleted successfully.');
    }

    public function bulkDestroy(Request $request): RedirectResponse
    {
        $ids = (array) $request->input('ids', []);

        $ads = Ad::whereIn('id', $ids)->get();

        foreach ($ads as $ad) {
            if ($ad->image_path) {
                Storage::disk('public')->delete($ad->image_path);
            }
        }

        Ad::whereIn('id', $ids)->delete();

        return redirect()
            ->route('backend.ads.index')
            ->with('success', count($ids) . ' ad(s) deleted successfully.');
    }

    public function toggleStatus(Ad $ad): RedirectResponse
    {
        $ad->update([
            'status' => $ad->status === 'active' ? 'inactive' : 'active',
        ]);

        return back()->with('success', 'Ad status updated.');
    }
}
