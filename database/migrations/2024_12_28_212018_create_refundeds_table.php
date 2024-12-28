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
        Schema::create('refundeds', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['refundAll', 'partialRefund']);
            $table->foreignId('current_invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->foreignId('refunded_invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refundeds');
    }
};
