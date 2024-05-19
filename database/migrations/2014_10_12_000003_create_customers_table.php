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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('type_customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name_customer');
            $table->string('type_business');
            $table->date('foundation_date')->nullable();
            $table->string('npwp');
            $table->string('owner');
            $table->string('total_employee');
            $table->string('address_customer');
            $table->string('city'); 
            $table->string('country');
            $table->string('phone_a');
            $table->string('phone_b')->nullable();
            $table->string('email_a');
            $table->string('email_b')->nullable();
            $table->text('desc_technical');
            $table->text('desc_clasification');
            $table->text('add_information');
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
