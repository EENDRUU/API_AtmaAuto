<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    protected $table = 'transaksi_penjualan';
    public $timestamps = false;
    protected $primaryKey = 'NOMOR_TRANSAKSI';
    public $incrementing = false;
    protected $fillable = [
        'ID_PEGAWAI','ID_KONSUMEN',
        'STATUS_BAYAR', 'DISKON','TANGGALPENJUALAN',
        'TOTALTRANSAKSIPENJUALAN'
    ];
}
