<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetilTransaksiPenjualanJasa extends Model
{
    protected $table = 'detail_transaksi_penjualanjasa';
    public $timestamps = false;
    protected $primaryKey = 'ID_DETAILPENJUALANJASA';
    public $incrementing = false;
    protected $fillable = [
        'NOMOR_TRANSAKSI','ID_JASA',
        'JUMLAHJASA','SUBTOTALJASA','NOMORPOLISI','STATUS'
    ];
}
