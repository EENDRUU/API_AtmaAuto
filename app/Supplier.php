<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    public $timestamps = false;
    protected $primaryKey = 'ID_SUPPLIER';
    public $incrementing = false;
    protected $fillable = [
        'NAMASUPPLIER','ALAMATSUPPLIER',
        'NAMASALES','NOMORTELEPON_SALES'
    ];
}
