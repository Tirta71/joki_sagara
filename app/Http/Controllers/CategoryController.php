<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->create($validated);

            return redirect()->route('categories.index')->with('status', 'Category created successfully');
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function index(): View|RedirectResponse
    {
        try {
            $categories = $this->service->getAll();

            return view('categories.index', compact('categories'));
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $category = $this->service->getById($id);

            return view('categories.show', compact('category'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function edit(string $id): View
    {
        try {
            $category = $this->service->getById($id);

            return view('categories.edit', compact('category'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function update(CategoryRequest $request, string $id): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->service->update($id, $validated);

            return redirect()->route('categories.show', $id)->with('status', 'Category updated successfully');
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

            return redirect()->route('categories.index')->with('status', 'Category deleted successfully');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }
}
