<?php

namespace App\Services;

use App\Repositories\AccumulatedDepreciationRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelServiceRepo\BaseService;

class AccumulatedDepreciationService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new AccumulatedDepreciationRepository();
    }

    public function create(array $data)
    {
        $data['created_by_id'] = Auth::id();
        $data['code'] = $this->generateCodeIncrement($data['code']);

        return $this->repository->addNewData($data);
    }

    public function getAll()
    {
        return $this->repository->orderColumn("code")->getAllData();
    }

    public function getByID(string $id)
    {
        $accumulatedDepreciation = $this->repository->getDataById($id);
        if (!$accumulatedDepreciation) {
            throw new ModelNotFoundException('Record not found');
        }

        return $accumulatedDepreciation;
    }

    public function update(string $id, array $data)
    {
        $accumulatedDepreciation = $this->getByID($id);

        $oldCode = $accumulatedDepreciation->code;
        $newCode = $data['code'];

        if (isset($newCode) && $oldCode !== $newCode) {
            $data['code'] = $this->generateCodeIncrement($newCode);
        }

        return AccumulatedDepreciationRepository::updateDataById($id, $data);
    }

    public function delete(string $id)
    {
        $deleted = $this->repository->deleteDataById($id);
        if (!$deleted) {
            throw new ModelNotFoundException('Record not found');
        }

        return $deleted;
    }

    private function generateCodeIncrement(string $baseCode): string
    {
        $lastRecord = $this->repository->getCode($baseCode);
        if (!$lastRecord) {
            return $baseCode . '.01';
        }

        $lastCode = $lastRecord->code;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '.') + 1));
        $nextNumber = $lastNumber + 1;

        return $baseCode . '.' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
    }
}
