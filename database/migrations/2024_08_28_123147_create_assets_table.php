<?php

use App\Enums\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Table::ASSETS->value, function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("name");
            $table->foreignUuid("location_area")
                ->references("id")
                ->on("locations")
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignUuid("category")
                ->references("id")
                ->on("categories")
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->string("custom_number")->unique();
            $table->foreignUuid("account_fixed_asset")
                ->references("id")
                ->on("fixed_assets")
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->text("description");
            $table->boolean("non_depreciation")->default(false);
            $table->enum("method", ["Straight Line", "Reducing Balance", null])->nullable();
            $table->uuid("depreciation_account")->nullable();
            $table->foreign("depreciation_account")
                ->references("id")
                ->on("depreciations")
                ->restrictOnDelete()
                ->restrictOnUpdate()
                ->nullable();
            $table->uuid("accumulated_depreciation_account")->nullable();
            $table->foreign("accumulated_depreciation_account")
                ->references("id")
                ->on("accumulation_depreciations")
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignUuid('created_by_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Table::ASSETS->value);
    }
};
