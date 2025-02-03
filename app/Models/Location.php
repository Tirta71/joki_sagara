<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "code",
        "name",
        "address",
        'created_by_id',
    ];

    public function creator() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
