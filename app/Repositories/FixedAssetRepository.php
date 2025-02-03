<?php

namespace App\Repositories;

use App\Models\FixedAsset;
use Illuminate\Database\Eloquent\Builder;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class FixedAssetRepository extends BaseRepository
{
    public function getBaseQuery(): Builder
    {
        return FixedAsset::query();
    }

    public function getCode(string $baseCode)
    {
        return $this->where('code', 'like', $baseCode . '.%')->latest('code')->first();
    }
}
