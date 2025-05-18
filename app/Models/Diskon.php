<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    // Diskon.php
public function pesanan() {
    return $this->hasMany(Pesanan::class, 'id');
}
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_diskon',
        'persentase',
        'tanggal_berlaku'
    ];
    protected $casts = [
        'tanggal_berlaku' => 'date',
    ];
}
