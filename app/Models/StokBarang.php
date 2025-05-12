<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_bahan', 'satuan', 'jumlah'];

    public function penggunaan()
    {
        return $this->hasMany(PenggunaanBahan::class, 'bahan_id');
    }
}
