<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KendaraanPelanggan extends Model
{
    protected $table = 'kendaraankonsumen';
    public $timestamps = false;
    protected $primaryKey = 'NOMORPOLISI';
    public $incrementing = false;
    protected $fillable = [
        'IDMEREK','IDTIPE',
    ];
}
