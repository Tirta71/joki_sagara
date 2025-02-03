<?php

namespace App\Repositories;

use App\Models\HistoryTransaction;
use Illuminate\Database\Eloquent\Builder;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class HistoryTransactionRepository extends BaseRepository
{
  public function getBaseQuery(): Builder
  {
    return HistoryTransaction::query();
  }

  public function getLastDepreciateByID(string $id)
  {
    return $this->builder->where('transaction_id', $id)->orderBy('created_at', 'desc')->first();
  }
}
