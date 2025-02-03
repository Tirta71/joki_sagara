<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetRequest;
use App\Services\AccumulatedDepreciationService;
use App\Services\AssetService;
use App\Services\CategoryService;
use App\Services\DepreciationService;
use App\Services\FixedAssetService;
use App\Services\LocationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AssetController extends Controller
{
    protected $assetService;
    protected $locationService;
    protected $categoryService;
    protected $fixedAssetService;
    protected $depreciationService;
    protected $accumulatedDepreciationService;

    public function __construct(AssetService $assetService, LocationService $locationService, CategoryService $categoryService, FixedAssetService $fixedAssetService, DepreciationService $depreciationService, AccumulatedDepreciationService $accumulatedDepreciationService)
    {
        $this->assetService = $assetService;
        $this->locationService = $locationService;
        $this->categoryService = $categoryService;
        $this->fixedAssetService = $fixedAssetService;
        $this->depreciationService = $depreciationService;
        $this->accumulatedDepreciationService = $accumulatedDepreciationService;
    }

    private function getAssetMasterData()
    {
        return [
            'locations' => $this->locationService->getAll(),
            'categories' => $this->categoryService->getAll(),
            'fixedAssets' => $this->fixedAssetService->getAll(),
            'depreciations' => $this->depreciationService->getAll(),
            'accumulatedDepreciations' => $this->accumulatedDepreciationService->getAll(),
        ];
    }

    public function create(): View
    {
        $assetMasterData = $this->getAssetMasterData();

        return view('assets.create', $assetMasterData);
    }

    public function store(AssetRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->assetService->create($validated);

            return redirect()->route('assets-sagara.index')->with('status', 'Asset created successfully');
        } catch (\Exception $e) {
            Log::error('kenapa nih', [$e]);
            return $this->handleError($e);
        }
    }

    public function index(): View|RedirectResponse
    {
        try {
            $assets = $this->assetService->getAll();

            return view('assets.index', compact('assets'));
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $asset = $this->assetService->getByID($id);

            return view('assets.show', compact('asset'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function edit(string $id): View|RedirectResponse
    {
        try {
            $asset = $this->assetService->getByID($id);
            $assetMasterData = $this->getAssetMasterData();

            return view('assets.edit', compact('asset') + $assetMasterData);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function update(string $id, AssetRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->assetService->update($id, $validated);

            return redirect()->route('assets-sagara.show', $id)->with('status', 'Asset updated successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->assetService->delete($id);

            return redirect()->route('assets-sagara.index')->with('status', 'Asset deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }
}
