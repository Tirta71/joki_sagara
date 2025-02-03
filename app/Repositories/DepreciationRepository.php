<?php

namespace App\Repositories;

use App\Models\Depreciation;
use Illuminate\Database\Eloquent\Builder;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class DepreciationRepository extends BaseRepository
{
    public function getBaseQuery(): Builder
    {
        return Depreciation::query();
    }

    public function getCode(string $baseCode)
    {
        return $this->where('code', 'like', $baseCode . '.%')->latest('code')->first();
    }
}
