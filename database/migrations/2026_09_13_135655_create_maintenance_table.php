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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('room_id');
            $table->string('work_order_no', 32)->unique('uk_maintenance_work_order_no');
            $table->unsignedInteger('reported_by');
            $table->unsignedInteger('assigned_to')->nullable();
            $table->string('category', 50);
            $table->enum('priority', ['LOW', 'MEDIUM', 'HIGH', 'CRITICAL'])->default('MEDIUM');
            $table->enum('status', ['REPORTED', 'IN_PROGRESS', 'RESOLVED', 'CLOSED', 'CANCELLED'])->default('REPORTED');
            $table->string('room_status_on_report', 32)->nullable();
            $table->string('description', 500);
            $table->string('resolution_notes', 500)->nullable();
            $table->date('scheduled_date')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('room_id', 'fk_maintenance_room')
                ->references('id')->on('room')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('reported_by', 'fk_maintenance_reporter')
                ->references('id')->on('user')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('assigned_to', 'fk_maintenance_assignee')
                ->references('id')->on('user')->onDelete('set null')->onUpdate('cascade');

            // Indexes
            $table->index(['room_id', 'status'], 'idx_maintenance_room_status');
            $table->index('assigned_to', 'idx_maintenance_assigned_to');
            $table->index('reported_by', 'idx_maintenance_reported_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
