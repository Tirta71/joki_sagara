<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class TransactionRepository extends BaseRepository
{
    public function getBaseQuery(): Builder
    {
        return Transaction::query();
    }
}
