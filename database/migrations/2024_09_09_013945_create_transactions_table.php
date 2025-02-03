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
        Schema::create(Table::TRANSACTIONS->value, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid("asset_id")
                ->references("id")
                ->on("assets")
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->string('name');
            $table->date("acquisition_date");
            $table->decimal("acquisition_cost", 15, 0);
            $table->integer("usage_period")->nullable();
            $table->float("usage_value_per_year")->nullable()->default(null);
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
        Schema::dropIfExists(Table::TRANSACTIONS->value);
    }
};
