<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'id','name','phoneNumber',
        'address','salary','role_id'
    ];
}
