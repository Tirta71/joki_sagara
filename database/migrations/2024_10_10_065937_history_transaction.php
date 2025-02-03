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
        Schema::create(Table::HISTORY_TRANSACTION->value, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid("transaction_id")
                ->references("id")
                ->on("transactions")
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->string('name');
            $table->decimal('depreciation_per_year', 15, 0);
            $table->decimal('depreciation_per_month', 15, 0);
            $table->decimal('value', 15, 0);
            $table->dateTime("depreciation_date")->nullable();
            $table->decimal("accumulation_depreciation_value", 15, 0)->nullable();
            $table->foreignUuid('created_by_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->timestamps();
            $table->unique(['transaction_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Table::HISTORY_TRANSACTION->value);
    }
};
