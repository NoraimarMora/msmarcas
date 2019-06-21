<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    protected $table = "cuentas_bancarias";

    protected $fillable = ['beneficiario', 'tipo_dni', 'dni', 'num_cuenta', 'tipo_cuenta', 'tienda_id'];

    public function tienda()
    {
        return $this->belongsTo('App\Tienda');
    }
}