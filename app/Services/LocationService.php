<?php

namespace App\Services;

use App\Repositories\LocationRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelServiceRepo\BaseService;

class LocationService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new LocationRepository();
    }

    public function create(array $data)
    {
        $data['created_by_id'] = Auth::id();

        return $this->repository->addNewData($data);
    }

    public function getAll()
    {
        return $this->repository->orderColumn("code")->getAllData();
    }

    public function getByID(string $id)
    {
        $category = $this->repository->getDataById($id);
        if (!$category) {
            throw new ModelNotFoundException('Record not found');
        }

        return $category;
    }

    public function update(string $id, array $data)
    {
        $this->getByID($id);

        return LocationRepository::updateDataById($id, $data);
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
