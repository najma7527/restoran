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
        // migration file
Schema::create('menus', function (Blueprint $table) {
    $table->id('id');
    $table->enum('category', ['Makanan', 'Minuman', 'Cemilan']);
    $table->string('nama_menu', 100);
    $table->decimal('harga', 10, 2);
    $table->integer('stok');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
