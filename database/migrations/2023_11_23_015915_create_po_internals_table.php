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
        Schema::create('po_internals', function (Blueprint $table) {
            $table->id();
            //new schema table
            $table->string('po_number')->unique();
            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('order_date');
            $table->string('created_by');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_internals');
    }
};
