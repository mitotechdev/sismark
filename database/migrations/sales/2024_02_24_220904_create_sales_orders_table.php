<?php

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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('so_number');
            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sales_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tax_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('payment');
            $table->foreignId('approval_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('order_date');
            $table->string('delivery_to');
            $table->string('created_by');
            $table->text('desc');
            $table->foreignId('branch_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('paid')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
