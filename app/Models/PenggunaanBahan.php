<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaanBahan extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'bahan_id', 'jumlah_digunakan'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function bahan()
    {
        return $this->belongsTo(StokBarang::class, 'bahan_id');
    }
}
