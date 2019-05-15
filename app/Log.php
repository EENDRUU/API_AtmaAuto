<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    public $timestamps = false;
    protected $primaryKey = 'id_log';
    public $incrementing = true;
    protected $fillable = [
        'tanggal','deskripsi'
    ];
}
