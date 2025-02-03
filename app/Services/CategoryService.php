<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelServiceRepo\BaseService;

class CategoryService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new CategoryRepository();
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
        
        return CategoryRepository::updateDataById($id, $data);
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
