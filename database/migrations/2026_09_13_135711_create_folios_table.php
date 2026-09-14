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
        Schema::create('folios', function (Blueprint $table) {
            $table->id();
            $table->string('folio_no', 64)->unique('uk_folios_no');
            $table->foreignId('reservation_id')->nullable()->constrained('reservation', 'id', 'fk_folios_res')
                ->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('guest_id')->constrained('guests', 'id', 'fk_folios_guest')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->enum('folio_type', ['ROOM', 'MASTER', 'INCIDENTAL', 'NON_GUEST'])->default('ROOM');
            $table->enum('status', ['OPEN', 'SETTLED', 'CLOSED', 'VOID'])->default('OPEN');
            $table->decimal('total_charges', 12, 2)->default(0.00);
            $table->decimal('total_payments', 12, 2)->default(0.00);
            $table->decimal('balance', 12, 2)->storedAs('`total_charges` - `total_payments`');
            $table->timestamp('opened_at')->useCurrent();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();

            $table->index(['reservation_id', 'status'], 'idx_folios_res_status');
            $table->index('guest_id', 'idx_folios_guest');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folios');
    }
};
