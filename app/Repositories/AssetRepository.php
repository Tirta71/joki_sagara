<?php

namespace App\Repositories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Builder;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class AssetRepository extends BaseRepository
{
    public function getBaseQuery(): Builder
    {
        return Asset::query();
    }
}
