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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no', 64)->unique('uk_invoices_no');
            $table->foreignId('folio_id')->constrained('folios', 'id', 'fk_invoices_folio')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('guest_id')->constrained('guests', 'id', 'fk_invoices_guest')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->date('issue_date');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('tax_amount', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0.00);
            $table->decimal('grand_total', 12, 2);
            $table->enum('status', ['DRAFT', 'ISSUED', 'PAID', 'VOID', 'REFUNDED'])->default('ISSUED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
