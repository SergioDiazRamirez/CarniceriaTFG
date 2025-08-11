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
            $table->text('ingredients')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('stock', 8, 3); // kilos en stock
            $table->string('image')->nullable(); // Path de la imagen
            $table->foreignId('sale_type_id')->constrained()->onDelete('restrict');
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
