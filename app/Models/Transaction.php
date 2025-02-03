<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'asset_id',
        'name',
        'acquisition_date',
        'acquisition_cost',
        'usage_period',
        'usage_value_per_year',
        "created_by_id",
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function historyTransaction(): HasMany
    {
        return $this->hasMany(HistoryTransaction::class);
    }
}
