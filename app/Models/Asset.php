<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Asset extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        "name",
        "location_area",
        "category",
        "custom_number",
        "account_fixed_asset",
        "description",
        "non_depreciation",
        "method",
        "depreciation_account",
        "accumulated_depreciation_account",
        "created_by_id",
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->custom_number = self::generateCustomId($model->location_area, $model->category);
        });
    }

    public static function generateCustomId($locationAreaUuid, $categoryUuid)
    {
        $locationCode = DB::table('locations')
            ->where('id', $locationAreaUuid)
            ->value('code');

        $categoryCode = DB::table('categories')
            ->where('id', $categoryUuid)
            ->value('code');

        if (!$locationCode || !$categoryCode) {
            throw new \Exception("Location or Category not found.");
        }

        $latest = DB::table('assets')
            ->join('locations', 'assets.location_area', '=', 'locations.id')
            ->join('categories', 'assets.category', '=', 'categories.id')
            ->where('locations.code', $locationCode)
            ->where('categories.code', $categoryCode)
            ->orderBy('assets.id', 'desc')
            ->first();

        $incremental = $latest ? (int)substr($latest->custom_number, -3) + 1 : 1;
        $incremental = str_pad($incremental, 3, '0', STR_PAD_LEFT);
        $identifier = sprintf('%s-%s-%02d-%s', $locationCode, $categoryCode, date('y'), $incremental);

        return $identifier;
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_area');
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, "category");
    }

    public function fixedAssets(): BelongsTo
    {
        return $this->belongsTo(FixedAsset::class, "account_fixed_asset");
    }

    public function depreciations(): BelongsTo
    {
        return $this->belongsTo(Depreciation::class, "depreciation_account");
    }

    public function accumulatedDepreciations(): BelongsTo
    {
        return $this->belongsTo(AccumulatedDepreciation::class, "accumulated_depreciation_account");
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
