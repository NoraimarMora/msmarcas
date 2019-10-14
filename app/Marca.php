<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = "marcas";

    protected $fillable = ['name', 'description', 'logo_url', 'banner_url', 'active'];

    public function tiendas()
    {
        return $this->hasMany('App\Tienda');
    }
}