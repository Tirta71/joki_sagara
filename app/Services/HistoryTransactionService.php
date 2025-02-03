<?php

namespace App\Services;

use App\Repositories\HistoryTransactionRepository;
use Iqbalatma\LaravelServiceRepo\BaseService;
use Carbon\Carbon;

class HistoryTransactionService extends BaseService
{
  protected $repository;
  protected $transactionService;

  public function __construct()
  {
    $this->repository = new HistoryTransactionRepository();
    $this->transactionService = new TransactionService();
  }

  public function getAll()
  {
    return $this->repository->getAllData();
  }

  public function getByID(string $id)
  {
    return $this->repository->getAllData(['transaction_id' => $id]);
  }

  public function depreciateMonthly($history, $transaction)
  {
    $lastDate = Carbon::parse($history->created_at);
    $currentDate = Carbon::now();
    $monthsElapsed = $lastDate->diffInMonths($currentDate);

    if ($monthsElapsed >= 1) {
      return $this->calculateDepreciation($history, $transaction);
    }
  }

  protected function calculateDepreciation($history, $transaction)
  {
    $method = $transaction->asset->method;
    if ($method == 'Straight Line') {
      return $this->calculateStraightLine($history, $transaction);
    } else {
      return $this->calculateReducingBalance($history, $transaction);
    }
  }

  public function calculateStraightLine($history, $transaction)
  {
    $acquisitionCost = (float) $history->value;
    $depreciatedValuePerMonth = (float) $history->depreciation_per_month;
    $depreciatedValue = $acquisitionCost - $depreciatedValuePerMonth;

    return $this->repository->addNewData([
      'transaction_id' => $transaction->id,
      'depreciation_per_year' => $history->depreciation_per_year,
      'depreciation_per_month' => $depreciatedValuePerMonth,
      'name' => $transaction->name,
      'value' => $depreciatedValue,
      'depreciation_date' => $history->depreciation_date,
      'created_by_id' => $transaction->created_by_id,
    ]);
  }

  public function calculateReducingBalance($history, $transaction)
  {
    $value = (float) $history->value;
    $acquisitionCost = (float) $transaction->acquisition_cost;
    $usageValuePerYear = $transaction->usage_value_per_year;

    $lastDate = Carbon::parse($history->depreciation_date);
    $currentDate = Carbon::now();
    $monthsElapsed = $lastDate->diffInMonths($currentDate);

    if ($monthsElapsed >= 12) {
      $remainingValue = $acquisitionCost - $value;
      $depreciatedValuePerYear = $remainingValue * $usageValuePerYear;
      $depreciatedValuePerMonth = $depreciatedValuePerYear / 12;

      $depreciatedValue = $remainingValue - $depreciatedValuePerMonth;

      return $this->repository->addNewData([
        'transaction_id' => $transaction->id,
        'name' => $transaction->name,
        'depreciation_per_year' => $depreciatedValuePerYear,
        'depreciation_per_month' => $depreciatedValuePerMonth,
        'value' => $depreciatedValue,
        'depreciation_date' => $history->depreciation_date,
        'created_by_id' => $transaction->created_by_id,
      ]);
    }

    $depreciatedValue = $value - $history->depreciation_per_month;

    return $this->repository->addNewData([
      'transaction_id' => $transaction->id,
      'name' => $transaction->name,
      'depreciation_per_year' => $history->depreciation_per_year,
      'depreciation_per_month' => $history->depreciation_per_month,
      'value' => $depreciatedValue,
      'depreciation_date' => $history->depreciation_date,
      'created_by_id' => $transaction->created_by_id,
    ]);
  }
}
