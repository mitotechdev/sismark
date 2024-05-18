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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('project_code')->unique();
            $table->foreignId('user_id')->default(1)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('start_date');
            $table->date('due_date');
            $table->text('desc_project');
            $table->string('created_by');
            $table->text('desc_prospect')->nullable();
            $table->foreignId('prospect_id')->default(1)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('market_progress_id')->default(1)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('routine')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
