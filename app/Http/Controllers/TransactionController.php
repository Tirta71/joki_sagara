<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use InvalidArgumentException;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(): View|RedirectResponse
    {
        try {
            $transactions = $this->transactionService->getAll();

            return view('transactions.index', compact('transactions'));
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $transaction = $this->transactionService->getByID($id);

            return view('transactions.show', compact('transaction'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }

    public function depreciate(string $id): View|RedirectResponse
    {
        try {
            $this->transactionService->depreciate($id);

            return redirect()->route('histories.index');
        } catch (InvalidArgumentException $e) {
            return redirect()->back()->withErrors(['error' => 'Cant depreciate again']);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'Record not found']);
        } catch (\Exception $e) {
            return $this->handleError($e);
        }
    }
}
