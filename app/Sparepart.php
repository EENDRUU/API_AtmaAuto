<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $table = 'sparepart';
    public $timestamps = false;
    protected $primaryKey = 'KODE_SPAREPART';
    public $incrementing = false;

    protected $fillable = [
        'HARGABELI', 'HARGAJUAL',
        'KODETEMPAT', 'STOK','MEREK',
        'TIPE','NAMASPAREPART'
    ];
}
