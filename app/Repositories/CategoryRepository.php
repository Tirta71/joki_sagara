<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function getBaseQuery(): Builder
    {
        return Category::query();
    }
}
