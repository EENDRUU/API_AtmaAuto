<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $table = 'konsumen';
    public $timestamps = false;
    protected $primaryKey = 'ID_KONSUMEN';
    public $incrementing = false;
    protected $fillable = [
        'NAMAKONSUMEN','ALAMATKONSUMEN',
        'NOMORTELEPON_KONSUMEN'
    ];
}
