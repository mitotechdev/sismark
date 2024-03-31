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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quo_code')->unique(); //ini untuk nomor sp (surat penawaran)
            $table->foreignId('project_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('type_expedition');
            $table->string('validated_quo');
            $table->string('tax_type');
            $table->text('desc_quo');
            // tambahkan column pembyaran [30 hari, 60 hari]
            $table->enum('payment_term', ['7 Hari', '14 Hari', '21 Hari', '30 Hari', '60 Hari', '90 Hari']);
            $table->enum('status', ['Draf', 'Request', 'Aprroved', 'Reject', 'Cancelled']);
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
