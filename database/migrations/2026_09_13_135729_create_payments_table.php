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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_no', 64)->unique('uk_payments_no');
            $table->foreignId('folio_id')->constrained('folios', 'id', 'fk_payments_folio')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('invoice_id')->nullable()->constrained('invoices', 'id', 'fk_payments_invoice')
                ->onDelete('set null')->onUpdate('cascade');
            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['CASH', 'CREDIT_CARD', 'DEBIT_CARD', 'BANK_TRANSFER', 'DIGITAL_WALLET']);
            $table->string('transaction_reference', 128)->nullable();
            $table->enum('payment_status', ['SUCCESS', 'FAILED', 'PENDING', 'REFUNDED', 'VOID'])->default('SUCCESS');
            $table->timestamp('paid_at')->useCurrent();
            $table->unsignedInteger('processed_by');
            $table->timestamp('created_at')->useCurrent();

            // Foreign Keys
            $table->foreign('processed_by', 'fk_payments_user')
                ->references('id')->on('user')->onDelete('restrict')->onUpdate('cascade');

            $table->index('processed_by', 'idx_payments_processed_by');
            $table->index('invoice_id', 'idx_payments_invoice');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
