<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders', 'id')
                ->cascadeOnDelete()
                ->index('order_items_order_id_index');

            $table->foreignId('product_id')
                ->constrained('products', 'id')
                ->cascadeOnDelete()
                ->index('order_items_product_id_index');

            $table->unsignedInteger('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('order_items');
    }
};
