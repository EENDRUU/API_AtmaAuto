<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $primaryKey = 'kode_sparepart';
    public $incrementing = false;

    protected $fillable = [
        'hargaBeli', 'hargaJual',
        'kodeTempat', 'stok','merek',
        'tipe','namaSparepart'
    ];
}
