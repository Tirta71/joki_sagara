<?php

namespace App\Repositories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Builder;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class LocationRepository extends BaseRepository
{
    public function getBaseQuery(): Builder
    {
        return Location::query();
    }
}
