<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Services\LocationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LocationController extends Controller
{
    protected $service;

    public function __construct(LocationService $service)
    {
        $this->service = $service;
    }

    public function create(): View
    {
        return view('locations.create');
    }

    public function store(LocationRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->create($validated);

            return redirect()->route('locations.index')->with('status', 'Location created successfully');
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function index(): View|RedirectResponse
    {
        try {
            $locations = $this->service->getAll();

            return view('locations.index', compact('locations'));
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $location = $this->service->getById($id);

            return view('locations.show', compact('location'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function edit(string $id): View|RedirectResponse
    {
        try {
            $location = $this->service->getById($id);

            return view('locations.edit', compact('location'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function update(LocationRequest $request, string $id): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->update($id, $validated);

            return redirect()->route('locations.show', $id)->with('status', 'Location updated successfully');
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

            return redirect()->route('locations.index')->with('status', 'Location deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }
}
