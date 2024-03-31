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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('market_progress_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name_task');
            $table->date('start_date');
            $table->time('time_task');
            $table->text('desc_task');
            $table->boolean('status_task')->default(0)->nullable(); // if (true) then status completed else status progress | status_task
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
