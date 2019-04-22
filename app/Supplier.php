<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'namaSupplier','alamatSupplier',
        'namaSales','nomorTeleponSales'
    ];
}
