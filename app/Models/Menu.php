<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // Menu.php
public function detailPesanan() {
    return $this->hasMany(DetailPesanan::class, 'id');
}
    protected $primaryKey = 'id';

    protected $fillable = [
        'category',
        'nama_menu',
        'harga',
        'stok',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
