<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    protected $table = "cuentas_bancarias";

    protected $fillable = ['beneficiary', 'dni_type', 'dni', 'account_number', 'account_type', 'tienda_id'];

    public function tienda()
    {
        return $this->belongsTo('App\Tienda');
    }
}