<?php

namespace App\Http\Controllers;

use App\Services\HistoryTransactionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HistoryTransactionController extends Controller
{
    protected $service;

    public function __construct(HistoryTransactionService $service)
    {
        $this->service = $service;
    }

    public function index(): View|RedirectResponse
    {
        try {
            $histories = $this->service->getAll();

            return view('histories.index', compact('histories'));
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $histories = $this->service->getByID($id);

            return view('histories.show', compact('histories'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }
}
