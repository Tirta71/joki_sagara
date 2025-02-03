<?php

namespace App\Http\Controllers;

use App\Http\Requests\FixedAssetRequest;
use App\Services\FixedAssetService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FixedAssetController extends Controller
{
    protected $service;

    public function __construct(FixedAssetService $service)
    {
        $this->service = $service;
    }

    public function create(): View
    {
        return view('fixed_assets.create');
    }

    public function store(FixedAssetRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->create($validated);

            return redirect()->route('fixed_assets.index')->with('status', 'Fixed Asset created successfully');
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function index(): View|RedirectResponse
    {
        try {
            $fixedAssets = $this->service->getAll();

            return view('fixed_assets.index', compact('fixedAssets'));
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function show(string $code): View|RedirectResponse
    {
        try {
            $fixedAsset = $this->service->getById($code);

            return view('fixed_assets.show', compact('fixedAsset'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function edit(string $code): View|RedirectResponse
    {
        try {
            $fixedAsset = $this->service->getById($code);

            return view('fixed_assets.edit', compact('fixedAsset'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function update(FixedAssetRequest $request, string $code): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->update($code, $validated);

            return redirect()->route('fixed_assets.show', $code)->with('status', 'Fixed Asset updated successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function destroy(string $code): RedirectResponse
    {
        try {
            $this->service->delete($code);

            return redirect()->route('fixed_assets.index')->with('status', 'Fixed Asset deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }
}
