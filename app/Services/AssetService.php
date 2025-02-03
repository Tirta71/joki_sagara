<?php

namespace App\Services;

use App\Repositories\AssetRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelServiceRepo\BaseService;

class AssetService extends BaseService
{
    protected $repository;
    protected $transactionRepo;

    public function __construct()
    {
        $this->repository = new AssetRepository();
        $this->transactionRepo = new TransactionRepository();
    }

    public function create(array $data)
    {
        $data['created_by_id'] = Auth::id();
        $nonDepreciation = $data['non_depreciation'] ?? '0';

        if ($nonDepreciation == '1') {
            $data['depreciation_account'] = null;
            $data['accumulated_depreciation_account'] = null;
            $data['method'] = null;
        }

        $asset = $this->repository->addNewData($data);

        $transactionData = $data;
        $transactionData['asset_id'] = $asset->id;
        $transactionData['location_id'] = $data['location_area'];
        $this->transactionRepo->addNewData($transactionData);

        return $asset;
    }

    public function getAll()
    {
        $assets = $this->repository->with([
            'location',
            'categories',
            'depreciations',
            'fixedAssets',
            'accumulatedDepreciations',
        ])->getAllData();

        $assets->each(function ($asset) {
            if ($asset->non_depreciation == 0) {
                $asset->category = $asset->categories->name;
                $asset->location_area = $asset->location->name;
                $asset->account_fixed_asset = $asset->fixedAssets->name;
                $asset->depreciation_account = $asset->depreciations->name;
                $asset->accumulation_depreciation_account = $asset->accumulatedDepreciations->name;
            } else {
                $asset->category = $asset->categories->name;
                $asset->account_fixed_asset = $asset->fixedAssets->name;
                $asset->location_area = $asset->location->name;
            }
        });

        return $assets;
    }

    public function getByID(string $id)
    {
        $asset = $this->repository->with([
            'location',
            'categories',
            'depreciations',
            'fixedAssets',
            'accumulatedDepreciations',
        ])->getDataById($id);
        if (!$asset) {
            throw new ModelNotFoundException('Record not found');
        }

        $asset->category = $asset->categories->name;
        $asset->location_area = $asset->location->name;
        $asset->account_fixed_asset = $asset->fixedAssets->name;
        $asset->depreciation_account = $asset->depreciations->name;
        $asset->accumulation_depreciation_account = $asset->accumulatedDepreciations->name;

        return $asset;
    }

    public function update(string $id, array $data)
    {
        $this->getByID($id);

        return AssetRepository::updateDataById($id, $data);
    }

    public function delete(string $id)
    {
        $deleted = $this->repository->deleteDataById($id);
        if (!$deleted) {
            throw new ModelNotFoundException('Record not found');
        }

        return $deleted;
    }
}
