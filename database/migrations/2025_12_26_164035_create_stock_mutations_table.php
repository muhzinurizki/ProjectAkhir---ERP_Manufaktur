<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_mutations', function (Blueprint $table) {
            $table->id();

            $table->enum('item_type', ['raw_material', 'product']);
            $table->unsignedBigInteger('item_id');

            $table->foreignId('warehouse_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('mutation_type', ['IN', 'OUT', 'ADJUST']);

            $table->string('reference_type')->nullable(); // GR, WO, DO, OPNAME, TRANSFER
            $table->unsignedBigInteger('reference_id')->nullable();

            $table->decimal('qty', 15, 3);
            $table->decimal('balance_after', 15, 3);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['item_type', 'item_id']);
            $table->index(['warehouse_id']);
            $table->index(['reference_type', 'reference_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_mutations');
    }
};
