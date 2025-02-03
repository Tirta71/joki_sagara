<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccumulatedDepreciation extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'accumulation_depreciations';

    protected $fillable = [
        "code",
        "name",
        'created_by_id',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
