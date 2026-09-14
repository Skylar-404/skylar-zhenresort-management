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
        Schema::create('room', function (Blueprint $table) {
            $table->increments('id'); // INT UNSIGNED AUTO_INCREMENT
            $table->string('building_code', 20);
            $table->string('room_number', 20);
            $table->tinyInteger('floor_number')->default(1);
            $table->string('room_type', 50)->index('idx_room_type');
            $table->decimal('base_rate', 10, 2);
            $table->unsignedTinyInteger('max_capacity')->default(2);
            $table->enum('status', [
                'AVAILABLE',
                'OCCUPIED',
                'RESERVED',
                'DIRTY',
                'CLEAN',
                'INSPECTED',
                'OUT_OF_ORDER',
                'UNDER_MAINTENANCE',
                'BLOCKED'
            ])->default('CLEAN')->index('idx_room_status');
            $table->boolean('is_smoking')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->unique(['building_code', 'room_number'], 'uk_room_building_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};
