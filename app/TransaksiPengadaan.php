<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPengadaan extends Model
{
    protected $table = 'transaksi_pemesanan_sparepart';
    public $timestamps = false;
    protected $primaryKey = 'ID_PESANAN';
    public $incrementing = false;
    protected $fillable = [
        'ID_SUPPLIER','TANGGALPEMESANAN',
        'TOTALBIAYAPEMESANAN','STATUS'
    ];
}
