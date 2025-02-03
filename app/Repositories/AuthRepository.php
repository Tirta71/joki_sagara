<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class AuthRepository extends BaseRepository
{
    public function getBaseQuery(): Builder
    {
        return User::query();
    }
}
