<?php

namespace App\Services;

use App\Repositories\HistoryTransactionRepository;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;
use Iqbalatma\LaravelServiceRepo\BaseService;

class TransactionService extends BaseService
{
    protected $repository;
    protected $historyTransactionRepository;

    public function __construct()
    {
        $this->repository = new TransactionRepository();
        $this->historyTransactionRepository = new HistoryTransactionRepository();
    }

    public function getAll()
    {
        return $this->repository->with('asset')->getAllData();
    }

    public function getByID(string $id)
    {
        $transaction = $this->repository->with('asset')->getDataById($id);
        if (!$transaction) {
            throw new ModelNotFoundException('Record not found');
        }

        return $transaction;
    }

    public function depreciate(string $id)
    {
        $transaction = $this->repository->getSingleData(['asset_id' => $id]);
        $method = $transaction->asset->method;
        $check = $this->historyTransactionRepository->getLastDepreciateByID($transaction->id);

        if (!$check) {
            $this->calculateDepreciation($transaction, $method);
        } else {
            throw new InvalidArgumentException('Cant calculate again');
        }
    }

    protected function calculateDepreciation($transaction, $method)
    {
        if ($method == 'Straight Line') {
            return $this->calculateStraightLine($transaction);
        } else {
            return $this->calculateReducingBalance($transaction);
        }
    }

    protected function calculateStraightLine($transaction)
    {
        $acquisitionCost = (float) $transaction->acquisition_cost;
        $usagePeriod = (float) $transaction->usage_period;
        $accumulationValue = (float) $transaction->accumulation_depreciation_value;
        
        $depreciatedValuePerYear = ($acquisitionCost - $accumulationValue) / $usagePeriod;
        $depreciatedValuePerMonth = $depreciatedValuePerYear / 12;

        $depreciatedValue = $acquisitionCost - $depreciatedValuePerMonth;

        return $this->historyTransactionRepository->addNewData([
            'transaction_id' => $transaction->id,
            'depreciation_per_year' => $depreciatedValuePerYear,
            'depreciation_per_month' => $depreciatedValuePerMonth,
            'name' => $transaction->name,
            'value' => $depreciatedValue,
            'depreciation_date' => Carbon::now(),
            'created_by_id' => $transaction->created_by_id,
        ]);
    }

    protected function calculateReducingBalance($transaction)
    {
        $acquisitionCost = (float) $transaction->acquisition_cost;
        $usageValuePerYear = $transaction->usage_value_per_year;

        $depreciatedValuePerYear = $acquisitionCost * $usageValuePerYear;
        $depreciatedValuePerMonth = $depreciatedValuePerYear / 12;

        $depreciatedValue = $acquisitionCost - $depreciatedValuePerMonth;

        return $this->historyTransactionRepository->addNewData([
            'transaction_id' => $transaction->id,
            'name' => $transaction->name,
            'depreciation_per_year' => $depreciatedValuePerYear,
            'depreciation_per_month' => $depreciatedValuePerMonth,
            'value' => $depreciatedValue,
            'depreciation_date' => Carbon::now(),
            'created_by_id' => $transaction->created_by_id,
        ]);
    }
}
