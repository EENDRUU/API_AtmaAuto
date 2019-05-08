<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetilTransaksiPenjualanSparepart extends Model
{
    protected $table = 'detail_transaksi_penjualanspar';
    public $timestamps = false;
    protected $primaryKey = 'ID_DETAILPENJUALANSPAREPART';
    public $incrementing = false;
    protected $fillable = [
        'NOMOR_TRANSAKSI','KODE_SPAREPART',
        'JUMLAH','SUBTOTALSPAREPART'
    ];
}
