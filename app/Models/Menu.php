<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // Menu.php
public function detailPesanan() {
    return $this->hasMany(DetailPesanan::class, 'id_menu');
}
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_menu',
        'harga',
        'kategori',
        'deskripsi',
        'gambar'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
