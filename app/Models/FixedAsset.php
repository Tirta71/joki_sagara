<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FixedAsset extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'fixed_assets';

    protected $fillable = [
        "code",
        "name",
        'created_by_id',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $baseCode = $model->code;

            $model->code = self::generateCustomId($baseCode);
        });
    }

    public static function generateCustomId(string $baseCode): string
    {
        $lastRecord = self::latest('code')->first();
        if (!$lastRecord) {
            return $baseCode . '.01';
        }

        $lastId = $lastRecord->code;
        $lastNumber = intval(substr($lastId, strrpos($lastId, '.') + 1));
        $nextNumber = $lastNumber + 1;

        return $baseCode . '.' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
