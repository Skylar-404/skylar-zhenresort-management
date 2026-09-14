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
        Schema::create('food_services', function (Blueprint $table) {
            $table->id();
            $table->string('order_no', 32)->unique('uk_fs_order_no');
            $table->string('outlet_name', 50);
            $table->enum('outlet_type', ['RESTAURANT', 'BAR', 'CAFE', 'ROOM_SERVICE', 'POOL_BAR']);
            $table->unsignedInteger('room_id')->nullable();
            $table->string('table_number', 20)->nullable();
            $table->unsignedInteger('server_id');
            $table->enum('order_status', ['OPEN', 'PREPARING', 'SERVED', 'BILLED', 'PAID', 'CANCELLED'])->default('OPEN');
            $table->json('order_items');
            $table->decimal('subtotal', 10, 2)->default(0.00);
            $table->decimal('tax_total', 10, 2)->default(0.00);
            $table->decimal('grand_total', 10, 2)->default(0.00);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('room_id', 'fk_fs_room')
                ->references('id')->on('room')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('server_id', 'fk_fs_server')
                ->references('id')->on('user')->onDelete('restrict')->onUpdate('cascade');

            $table->index(['room_id', 'order_status'], 'idx_fs_room_status');
            $table->index('server_id', 'idx_fs_server');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_services');
    }
};
