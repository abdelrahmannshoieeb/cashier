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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('box_value');
            $table->boolean('adding_customers_fund_to_box');
            $table->boolean('adding_sellers_fund_to_box');
            $table->boolean('subtract_Suppliers_fund_from_box');
            $table->boolean('subtract_Procurement_fund_from_box');
            $table->boolean('subtract_Expenses_from_box');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
