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
        Schema::create('folio_charges', function (Blueprint $table) {
            $table->id();
            $table->string('charge_no', 64)->unique('uk_fc_charge_no');
            $table->foreignId('folio_id')->constrained('folios', 'id', 'fk_fc_folio')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->enum('service_category', ['ROOM', 'FOOD_BEVERAGE', 'SPA', 'ACTIVITY', 'LAUNDRY', 'MISC']);
            $table->foreignId('food_service_order_id')->nullable()->constrained('food_services', 'id', 'fk_fc_food_service')
                ->onDelete('set null')->onUpdate('cascade');
            $table->string('item_description', 255);
            $table->decimal('unit_price', 12, 2);
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->decimal('tax_amount', 12, 2)->default(0.00);
            $table->decimal('total_amount', 12, 2);
            $table->boolean('is_voided')->default(0);
            $table->unsignedInteger('posted_by');
            $table->timestamp('posted_at')->useCurrent();

            // Foreign Key
            $table->foreign('posted_by', 'fk_fc_user')
                ->references('id')->on('user')->onDelete('restrict')->onUpdate('cascade');

            $table->index('posted_by', 'idx_fc_posted_by');
            $table->index(['folio_id', 'service_category'], 'idx_fc_folio_category');
            $table->index('food_service_order_id', 'idx_fc_order_ref');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folio_charges');
    }
};
