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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('notes')->nullable();
            $table->string('pocket_number');
            $table->integer('balance');
            $table->integer('sell_price');
            $table->integer('credit_limit')->nullable();
            $table->integer('credit_limit_days')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
