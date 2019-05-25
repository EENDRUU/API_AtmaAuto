<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{

    protected $table = 'pegawai';
    protected $primaryKey = 'ID_PEGAWAI';
    public $timestamps = false;
    public $incrementing = false;


    protected $fillable = [
        'NAMA_PEGAWAI','NOMORTELEPON_PEGAWAI',
        'ALAMAT','GAJI','ID_ROLE'
    ];
}
