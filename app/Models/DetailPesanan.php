<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    // DetailPesanan.php
public function pesanan() {
    return $this->belongsTo(Pesanan::class, 'id_pesanan');
}
public function menu() {
    return $this->belongsTo(Menu::class, 'id_menu');
}
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pesanan',
        'id_menu',
        'jumlah',
        'harga_satuan',
        'subtotal'
    ];

    public function getSubtotalAttribute()
    {
        return $this->jumlah * $this->harga_satuan;
    }

}
