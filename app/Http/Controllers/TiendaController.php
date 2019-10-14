<?php

namespace App\Http\Controllers;

use App\Tienda;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TiendaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAll()
    {
        $tiendas = Tienda::all();

        foreach($tiendas as $tienda) {
            $marca = $tienda->marca;
        }

        return response()->json([
            'status' => 200,
            'tiendas' => $tiendas
        ]);
    }

    public function getActive()
    {
        $tiendas = Tienda::where('active', 1)->get();

        foreach($tiendas as $tienda) {
            $marca = $tienda->marca;
        }

        return response()->json([
            'status' => 200,
            'tiendas' => $tiendas
        ]);
    }

    public function getById($store_id)
    {
        try {
            $tienda = Tienda::findOrFail($store_id);

            return response()->json([
                'status' => 200,
                'tienda' => $tienda,
                'marca' => $tienda->marca
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }        
    }

    public function getCuentasByTiendaId($store_id)
    {
        try {
            $tienda = Tienda::findOrFail($store_id);

            return response()->json([
                'status' => 200,
                'tienda' => $tienda->cuentasBancarias
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }

    public function getHorariosByTiendaId($store_id)
    {
        try {
            $tienda = Tienda::findOrFail($store_id);

            return response()->json([
                'status' => 200,
                'tienda' => $tienda->horarios
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }

    public function store(Request $request)
    {
        $tienda = new Tienda();
        $tienda->name = $request->all()['name'];
        $tienda->latitude = $request->all()['latitude'];
        $tienda->longitude = $request->all()['longitude'];
        $tienda->brand_id = $request->all()['brand_id'];
        $tienda->save();

        return response()->json([
            'status' => 200,
            'tienda' => $tienda
        ]);
    }

    public function update(Request $request, $store_id)
    {
        try {
            $tienda = Tienda::findOrFail($store_id);

            $tienda->name = $request->all()['name'];
            $tienda->latitude = $request->all()['latitude'];
            $tienda->longitude = $request->all()['longitude'];
            $tienda->brand_id = $request->all()['brand_id'];
            $tienda->save();

            return response()->json([
                'status' => 200,
                'tienda' => $tienda
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }

    public function destroy($store_id)
    {
        try {
            $tienda = Tienda::findOrFail($store_id);

            $tienda->delete();

            return response()->json([
                'status' => 200,
                'message' => "Tienda eliminada"
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }
}
