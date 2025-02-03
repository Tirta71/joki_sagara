<?php

namespace App\Repositories;

use App\Models\AccumulatedDepreciation;
use Illuminate\Database\Eloquent\Builder;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class AccumulatedDepreciationRepository extends BaseRepository
{
    public function getBaseQuery(): Builder
    {
        return AccumulatedDepreciation::query();
    }

    public function getCode(string $baseCode)
    {
        return $this->where('code', 'like', $baseCode . '.%')->latest('code')->first();
    }
}
