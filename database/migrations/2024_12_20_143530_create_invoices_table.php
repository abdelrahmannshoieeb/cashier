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
            $table->double('total', 15, 2);
            $table->enum('payMethod', ['creditCard', 'cash', 'cheque', 'credit']);
            $table->double('payedAmount', 15, 2);
            $table->text('notes')->nullable();
            $table->double('discount', 15, 2)->default(0);
            $table->enum('status', ['unpaid', 'paid', 'partiallyPaid', 'cancelled']);
            $table->enum('customerType', ['unattached', 'attached']);
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete()->nullable();
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
