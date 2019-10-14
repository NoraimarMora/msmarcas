<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $table = "tiendas";

    protected $fillable = ['name', 'latitude', 'longitude', 'brand_id', 'active'];

    public function marca()
    {
        return $this->belongsTo('App\Marca');
    }

    public function cuentasBancarias()
    {
        return $this->hasMany('App\CuentaBancaria');
    }

    public function horarios()
    {
        return $this->hasMany('App\Horario');
    }
}