<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = "horarios";

    protected $fillable = ['day', 'open', 'close', 'store_id'];

    public function tienda()
    {
        return $this->belongsTo('App\Tienda');
    }
}