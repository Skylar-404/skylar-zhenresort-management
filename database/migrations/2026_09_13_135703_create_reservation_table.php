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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_no', 32)->unique('uk_reservation_no');
            $table->foreignId('guest_id')->constrained('guests', 'id', 'fk_res_guest')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedInteger('room_id');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->timestamp('actual_check_in_at')->nullable();
            $table->timestamp('actual_check_out_at')->nullable();
            $table->decimal('nightly_rate', 10, 2);
            $table->enum('status', ['CONFIRMED', 'CHECKED_IN', 'CHECKED_OUT', 'CANCELLED', 'NO_SHOW'])
                ->default('CONFIRMED')->index('idx_reservation_status');
            $table->enum('booking_source', ['DIRECT', 'WEBSITE', 'OTA_BOOKING', 'OTA_EXPEDIA', 'PHONE', 'WALK_IN'])
                ->default('DIRECT');
            $table->unsignedTinyInteger('adults_count')->default(1);
            $table->unsignedTinyInteger('children_count')->default(0);
            $table->string('special_instructions', 500)->nullable();
            $table->unsignedInteger('created_by');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('room_id', 'fk_res_room')
                ->references('id')->on('room')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('created_by', 'fk_res_user')
                ->references('id')->on('user')->onDelete('restrict')->onUpdate('cascade');

            // Indexes
            $table->index(['room_id', 'check_in_date', 'check_out_date'], 'idx_reservation_dates');
            $table->index('created_by', 'idx_res_created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
