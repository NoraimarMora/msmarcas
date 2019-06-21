<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Tienda;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MarcaController extends Controller
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
        $marcas = Marca::all();

        foreach($marcas as $marca) {
            $tiendas = $marca->tiendas;
        }

        return response()->json([
            'status' => 200,
            'marcas' => $marcas
        ]);
    }

    public function getActive()
    {
        $marcas = Marca::where('activo', 1)->get();

        return response()->json([
            'status' => 200,
            'marcas' => $marcas
        ]);
    }

    public function getById($marca_id)
    {
        try {
            $marca = Marca::findOrFail($marca_id);

            return response()->json([
                'status' => 200,
                'marca' => $marca,
                'tiendas' => $marca->tiendas
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }        
    }

    public function getTiendasByMarcaId($marca_id)
    {
        try {
            $marca = Marca::findOrFail($marca_id);

            return response()->json([
                'status' => 200,
                'tiendas' => $marca->tiendas
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
        $marca = new Marca();
        $marca->nombre = $request->all()['nombre'];
        $marca->descripcion = $request->all()['descripcion'];
        $marca->logo_url = $request->all()['logo_url'];
        $marca->banner_url = $request->all()['banner_url'];
        $marca->activo = $request->all()['activo'];
        $marca->save();

        return response()->json([
            'status' => 200,
            'marca' => $marca
        ]);
    }

    public function update(Request $request, $marca_id)
    {
        try {
            $marca = Marca::findOrFail($marca_id);

            $marca->nombre = $request->all()['nombre'];
            $marca->descripcion = $request->all()['descripcion'];
            $marca->logo_url = $request->all()['logo_url'];
            $marca->banner_url = $request->all()['banner_url'];
            $marca->activo = $request->all()['activo'];
            $marca->save();

            return response()->json([
                'status' => 200,
                'marca' => $marca
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }

    public function destroy($marca_id)
    {
        try {
            $marca = Marca::findOrFail($marca_id);

            $marca->delete();

            return response()->json([
                'status' => 200,
                'message' => "Marca eliminada"
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }
}
