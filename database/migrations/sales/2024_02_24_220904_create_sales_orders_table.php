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
            $table->date('order_date');
            $table->string('term');
            $table->string('ship_to');
            $table->boolean('taxable')->default(false);
            $table->string('created_by');
            $table->decimal('total_amount', 10,2)->default(0);
            $table->enum('status', ['draf', 'request', 'approved', 'reject', 'cancelled', 'pending'])->default('draf');
            $table->text('desc');
            $table->string('sales_person');
            $table->foreignId('branch_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
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
