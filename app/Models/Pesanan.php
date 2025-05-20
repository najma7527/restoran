<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    // Pesanan.php
public function metodePembayaran() {
    return $this->belongsTo(MetodePembayaran::class, 'id_metode');
}
public function diskon() {
    return $this->belongsTo(Diskon::class, 'id_diskon');
}
public function detailPesanan() {
    return $this->hasMany(DetailPesanan::class, 'id_pesanan');
}


    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_pelanggan',
        'total_harga',
        'pembayaran',
        'kembalian',
        'id_metode',
        'id_diskon',
        'tanggal',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function getTotalHargaAttribute()
    {
        return $this->detailPesanan->sum(function ($detail) {
            return $detail->jumlah * $detail->harga_satuan;
        });
    }
    // public function getStatusAttribute($value)
    // {
    //     return $value === 1 ? 'Selesai' : 'Belum Selesai';
    // }
    // public function setStatusAttribute($value)
    // {
    //     $this->attributes['status'] = $value === 'Selesai' ? 1 : 0;
    // }
}
