<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepreciationRequest;
use App\Services\DepreciationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepreciationController extends Controller
{
    protected $service;

    public function __construct(DepreciationService $service)
    {
        $this->service = $service;
    }

    public function create(): View
    {
        return view('depreciations.create');
    }

    public function store(DepreciationRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->create($validated);

            return redirect()->route('depreciations.index')->with('status', 'Depreciation created successfully');
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function index(): View|RedirectResponse
    {
        try {
            $depreciations = $this->service->getAll();

            return view('depreciations.index', compact('depreciations'));
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $depreciation = $this->service->getById($id);

            return view('depreciations.show', compact('depreciation'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function edit(string $id): View|RedirectResponse
    {
        try {
            $depreciation = $this->service->getById($id);

            return view('depreciations.edit', compact('depreciation'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function update(string $id, DepreciationRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->update($id, $validated);

            return redirect()->route('depreciations.show', $id)->with('status', 'Depreciations updated successfully');
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

            return redirect()->route('depreciations.index')->with('status', 'Depreciations deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }
}
