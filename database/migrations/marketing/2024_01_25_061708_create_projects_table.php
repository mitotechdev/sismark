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
            $table->string('project_code');
            $table->string('project_name');
            $table->enum('assign_to', ['Sintia Lestari', 'Yudha Satria'])->default('Sintia Lestari');
            $table->date('start_date');
            $table->date('due_date');
            $table->enum('status', ['Ongoing', 'Completed', 'Inactive', 'Canceled', 'Critical']);
            $table->text('desc_project');
            $table->enum('created_by', ['gea'])->default('gea');
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
