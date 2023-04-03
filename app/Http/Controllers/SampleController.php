<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SampleStoreRequest;
use App\Http\Requests\SampleUpdateRequest;
use App\Models\Sample;
use Illuminate\Http\Request;

final class SampleController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('view-any', Sample::class);

        $search = $request->get('search', '');

        $samples = Sample::search($search)
            ->latest()
            ->paginate(20);

        return view('app.samples.index', compact('samples', 'search'));
    }

    public function create(Request $request): View
    {
        $this->authorize('create', Sample::class);

        return view('app.samples.create');
    }

    public function store(SampleStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Sample::class);

        $validated = $request->validated();

        $sample = Sample::create($validated);

        return redirect()
            ->route('samples.edit', $sample)
            ->withSuccess(__('crud.common.created'));
    }

    public function show(Request $request, Sample $sample): View
    {
        $this->authorize('view', $sample);

        return view('app.samples.show', compact('sample'));
    }

    public function edit(Request $request, Sample $sample): View
    {
        $this->authorize('update', $sample);

        return view('app.samples.edit', compact('sample'));
    }

    public function update(SampleUpdateRequest $request, Sample $sample): RedirectResponse
    {
        $this->authorize('update', $sample);

        $validated = $request->validated();

        $sample->update($validated);

        return redirect()
            ->route('samples.edit', $sample)
            ->withSuccess(__('crud.common.saved'));
    }

    public function destroy(Request $request, Sample $sample): RedirectResponse
    {
        $this->authorize('delete', $sample);

        $sample->delete();

        return redirect()
            ->route('samples.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
