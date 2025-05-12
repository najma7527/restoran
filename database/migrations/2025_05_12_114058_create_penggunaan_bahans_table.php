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
        Schema::create('penggunaan_bahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_menu')->constrained('menus')-> onDelete('cascade');
            $table->foreignId('id_bahan')->constrained('stok_barangs')-> onDelete('cascade');
            $table->decimal('jumlah_digunakan', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_bahans');
    }
};
