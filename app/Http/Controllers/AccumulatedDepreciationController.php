<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccumulatedDepreciationRequest;
use App\Services\AccumulatedDepreciationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AccumulatedDepreciationController extends Controller
{
    protected $service;

    public function __construct(AccumulatedDepreciationService $service)
    {
        $this->service = $service;
    }

    public function create(): View
    {
        return view('accumulated_depreciations.create');
    }

    public function store(AccumulatedDepreciationRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->create($validated);

            return redirect()->route('accumulated_depreciations.index')->with('status', 'Accumulated Depreciation created successfully');
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function index(): View|RedirectResponse
    {
        try {
            $accumulatedDepreciations = $this->service->getAll();

            return view('accumulated_depreciations.index', compact('accumulatedDepreciations'));
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $accumulatedDepreciation = $this->service->getById($id);

            return view('accumulated_depreciations.show', compact('accumulatedDepreciation'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function edit(string $id): View|RedirectResponse
    {
        try {
            $accumulatedDepreciation = $this->service->getById($id);

            return view('accumulated_depreciations.edit', compact('accumulatedDepreciation'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function update(AccumulatedDepreciationRequest $request, string $id): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->update($id, $validated);

            return redirect()->route('accumulated_depreciations.show', $id)->with('status', 'Accumulated Depreciation updated successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->service->delete($id);

            return redirect()->route('accumulated_depreciations.index')->with('status', 'Accumulated Depreciation deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }
}
