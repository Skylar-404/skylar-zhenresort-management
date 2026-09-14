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
        Schema::create('guests', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT
            $table->string('first_name', 80);
            $table->string('last_name', 80);
            $table->string('email', 191)->nullable()->index('idx_guests_email');
            $table->string('phone', 32)->index('idx_guests_phone');
            $table->enum('identification_type', ['PASSPORT', 'NATIONAL_ID', 'DRIVING_LICENSE', 'OTHER']);
            $table->string('identification_no', 100);
            $table->char('country_code', 2);
            $table->string('address', 255)->nullable();
            $table->string('city', 100)->nullable();
            $table->enum('vip_status', ['STANDARD', 'SILVER', 'GOLD', 'PLATINUM'])->default('STANDARD');
            $table->text('special_requests')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['identification_type', 'identification_no'], 'uk_guests_id_doc');
            $table->index(['last_name', 'first_name'], 'idx_guests_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
