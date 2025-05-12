<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    // MetodePembayaran.php
public function pesanan() {
    return $this->hasMany(Pesanan::class, 'id_metode');
}
    protected $primaryKey = 'id_metode';
    protected $fillable = [
        'nama_metode',
        'deskripsi'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];  
}
