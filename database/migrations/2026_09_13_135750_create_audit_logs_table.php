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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('actor_user_id')->nullable();
            $table->string('action', 32);
            $table->string('table_name', 64);
            $table->unsignedBigInteger('record_id');
            $table->json('diff_before')->nullable();
            $table->json('diff_after')->nullable();
            $table->string('ip_address', 45);
            $table->string('user_agent', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();

            // Foreign Key
            $table->foreign('actor_user_id', 'fk_audit_user')
                ->references('id')->on('user')->onDelete('set null')->onUpdate('cascade');

            $table->index(['table_name', 'record_id'], 'idx_audit_table_record');
            $table->index(['actor_user_id', 'created_at'], 'idx_audit_actor_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
