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
            $table->ulid('id')->primary();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('open')->index();
            $table->string('priority')->default('medium')->index();
            $table->foreignUlid('workflow_id')->constrained()->restrictOnDelete();
            $table->ulid('current_workflow_step_id')->nullable()->index();
            $table->unsignedSmallInteger('current_step_index')->default(0);
            $table->foreignUlid('assigned_team_id')->nullable()->constrained('teams')->nullOnDelete();
            $table->foreignUlid('assigned_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignUlid('created_by_id')->constrained('users')->restrictOnDelete();
            $table->timestamp('due_at')->nullable()->index();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable()->index();
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('last_transitioned_at')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['workflow_id', 'status']);
            $table->index(['assigned_user_id', 'status']);
            $table->index(['assigned_team_id', 'status']);
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
