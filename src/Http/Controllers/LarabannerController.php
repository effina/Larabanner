<?php

namespace effina\Larabanner\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use effina\Larabanner\Models\Larabanner;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class LarabannerController extends Controller
{
    /**
     * Display a listing of the banners.
     */
    public function index(): View
    {
        $banners = Larabanner::latest()
                             ->paginate(config('larabanner.pagination', 15));

        return view('larabanner::index', compact('banners'));
    }

    /**
     * Show the form for creating a new banner.
     */
    public function create(): View
    {
        return view('larabanner::create');
    }

    /**
     * Store a newly created banner in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateBanner($request);

        Larabanner::create($validated);

        return redirect()
            ->route('larabanner.index')
            ->with('success', 'Banner created successfully.');
    }

    /**
     * Display the specified banner.
     */
    public function show(Larabanner $banner): View
    {
        return view('larabanner::show', compact('banner'));
    }

    /**
     * Show the form for editing the specified banner.
     */
    public function edit(Larabanner $banner): View
    {
        return view('larabanner::edit', compact('banner'));
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(Request $request, Larabanner $banner): RedirectResponse
    {
        $validated = $this->validateBanner($request);

        $banner->update($validated);

        return redirect()
            ->route('larabanner.index')
            ->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified banner from storage.
     */
    public function destroy(Larabanner $banner): RedirectResponse
    {
        $banner->delete();

        return redirect()
            ->route('larabanner.index')
            ->with('success', 'Banner deleted successfully.');
    }

    /**
     * Validate the banner request.
     *
     * @param Request $request
     * @return array
     */
    protected function validateBanner(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contents' => ['required', 'string'],
            'display_days' => ['nullable', 'array'],
            'display_days.*' => ['in:sun,mon,tue,wed,thu,fri,sat'],
            'display_start_date' => ['required', 'date'],
            'display_stop_date' => ['nullable', 'date', 'after:display_start_date'],
        ]);
    }
}
