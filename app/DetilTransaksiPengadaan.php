<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetilTransaksiPengadaan extends Model
{
    protected $table = 'detail_transaksipemesanan';
    public $timestamps = false;
    protected $primaryKey = 'ID_DETILPEMESANAN';
    public $incrementing = false;
    protected $fillable = [
        'KODE_SPAREPART','ID_PESANAN',
        'HARGABELISPAREPART','SATUAN','JUMLAH','SUBTOTALPEMESANAN'
    ];
}
