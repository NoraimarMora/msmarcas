<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = "marcas";

    protected $fillable = ['nombre', 'descripcion', 'logo_url', 'banner_url', 'activo'];

    public function tiendas()
    {
        return $this->hasMany('App\Tienda');
    }
}