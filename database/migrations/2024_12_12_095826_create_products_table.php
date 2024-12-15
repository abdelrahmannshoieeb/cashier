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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->integer('price1');
            $table->integer('price2');
            $table->integer('price3');
            $table->integer('buying price');
            $table->integer('itemStock')->nullable();
            $table->integer('PacketStock')->nullable();
            $table->integer('items_in_packet')->nullable();
            $table->integer('stockAlert')->nullable();
            $table->date('endDate')->nullable();
            $table->boolean('isActive')->default(1);

            
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
