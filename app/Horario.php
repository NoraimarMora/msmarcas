<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = "horarios";

    protected $fillable = ['dia', 'abierto', 'cerrado', 'tienda_id'];

    public function tienda()
    {
        return $this->belongsTo('App\Tienda');
    }
}