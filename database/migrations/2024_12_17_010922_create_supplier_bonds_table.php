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
        Schema::create('supplier_bonds', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['add', 'subtract']);
            $table->integer('value');
            $table->string('notes');
            $table->enum('method', ['cash', 'credit' , 'cheque']);
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_bonds');
    }
};
