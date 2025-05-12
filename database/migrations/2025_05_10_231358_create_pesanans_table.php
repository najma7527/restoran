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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_pelanggan', 100);
            $table->decimal('total_harga', 10, 2);
            $table->decimal('pembayaran', 10, 2);
            $table->decimal('kembalian', 10, 2);
            $table->foreignId('id_metode')->constrained('metode_pembayarans');
            $table->foreignId('id_diskon')->nullable()->constrained('diskons');
            $table->dateTime('tanggal');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
