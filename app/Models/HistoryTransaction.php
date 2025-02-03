<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryTransaction extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'history_transactions';

    protected $fillable = [
        'name',
        'transaction_id',
        'depreciation_per_year',
        'depreciation_per_month',
        'value',
        'depreciation_date',
        'accumulation_depreciation_value',
        'created_by_id'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
