<?php
// app/Http/Controllers/Backend/PageController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\StorePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(Request $request): View
    {
        $pages = Page::query()
            ->when($request->filled('search'), fn ($q) =>
                $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->filled('type'), function ($q) use ($request) {
                $request->type === 'system' ? $q->system() : $q->custom();
            })
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        return view('backend.page.index', compact('pages'));
    }

    public function create(): View
    {
        return view('backend.page.create');
    }

    public function store(StorePageRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')
                ->store('pages', 'public');
        }

        $data['user_id'] = $request->user()->id;

        $page = Page::create($data);

        return redirect()
            ->route('backend.pages.index')
            ->with('success', "Page \"{$page->title}\" created successfully.");
    }

    public function edit(Page $page): View
    {
        return view('backend.page.edit', compact('page'));
    }

    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')
                ->store('pages', 'public');
        }

        $page->update($data);

        return redirect()
            ->route('backend.pages.index')
            ->with('success', "Page \"{$page->title}\" updated successfully.");
    }

    public function destroy(Page $page): RedirectResponse
    {
        if ($page->is_system) {
            return back()->with('error', 'System pages cannot be deleted.');
        }

        if ($page->featured_image) {
            Storage::disk('public')->delete($page->featured_image);
        }

        $page->delete();

        return redirect()
            ->route('backend.pages.index')
            ->with('success', 'Page deleted successfully.');
    }

    public function bulkDestroy(Request $request): RedirectResponse
    {
        $request->validate([
            'ids'   => ['required', 'array'],
            'ids.*' => ['integer', 'exists:pages,id'],
        ]);

        $pages = Page::whereIn('id', $request->ids)->custom()->get();

        foreach ($pages as $page) {
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }
        }

        $deleted = Page::whereIn('id', $pages->pluck('id'))->delete();

        return redirect()
            ->route('backend.pages.index')
            ->with('success', "{$deleted} page(s) deleted successfully.");
    }
}
