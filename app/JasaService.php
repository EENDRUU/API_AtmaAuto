<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JasaService extends Model
{
    protected $table = 'jasa';
    public $timestamps = false;
    protected $primaryKey = 'ID_JASA';
    public $incrementing = false;

    protected $fillable = [
        'HARGAJASA', 'NAMAJASA'
    ];
}
