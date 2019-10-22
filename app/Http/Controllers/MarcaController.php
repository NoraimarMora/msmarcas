<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Tienda;
use App\Broker;

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
        $response = Marca::all();
        $marcas = array();

        foreach ($response as $marca) {
            $tiendas = array();

            foreach ($marca->tiendas as $tienda) {
                array_push($tiendas, array(
                    "id" => $tienda->id,
                    "name" => $tienda->name,
                    "latitude" => $tienda->latitude,
                    "longitude" => $tienda->longitude,
                    "active" => $tienda->active,
                    "brand_id" => $tienda->marca_id,
                    "date_created" => $tienda->created_at
                ));
            }

            array_push($marcas, array(
                "id" => $marca->id,
                "name" => $marca->name,
                "description" => $marca->description,
                "logo_url" => $marca->logo_url,
                "banner_url" => $marca->banner_url,
                "active" => $marca->active,
                "date_created" => $marca->created_at,
                "stores" => $tiendas
            ));
        }

        return response()->json([
            'status' => 200,
            'brands' => $marcas
        ]);
    }

    public function getActive()
    {
        $response = Marca::where('active', 1)->get();
        $marcas = array();

        foreach ($response as $marca) {
            $tiendas = array();

            foreach ($marca->tiendas as $tienda) {
                array_push($tiendas, array(
                    "id" => $tienda->id,
                    "name" => $tienda->name,
                    "latitude" => $tienda->latitude,
                    "longitude" => $tienda->longitude,
                    "active" => $tienda->active,
                    "brand_id" => $tienda->marca_id,
                    "date_created" => $tienda->created_at
                ));
            }

            array_push($marcas, array(
                "id" => $marca->id,
                "name" => $marca->name,
                "description" => $marca->description,
                "logo_url" => $marca->logo_url,
                "banner_url" => $marca->banner_url,
                "active" => $marca->active,
                "date_created" => $marca->created_at,
                "stores" => $tiendas
            ));
        }

        return response()->json([
            'status' => 200,
            'brands' => $marcas
        ]);
    }

    public function getById($marca_id)
    {
        try {
            $response = Marca::findOrFail($marca_id);
            $tiendas = array();

            foreach ($response->tiendas as $tienda) {
                array_push($tiendas, array(
                    "id" => $tienda->id,
                    "name" => $tienda->name,
                    "latitude" => $tienda->latitude,
                    "longitude" => $tienda->longitude,
                    "active" => $tienda->active,
                    "brand_id" => $tienda->marca_id,
                    "date_created" => $tienda->created_at
                ));
            }

            $marca = array(
                "id" => $response->id,
                "name" => $response->name,
                "description" => $response->description,
                "logo_url" => $response->logo_url,
                "banner_url" => $response->banner_url,
                "active" => $response->active,
                "date_created" => $response->created_at,
                "stores" => $tiendas
            );

            return response()->json([
                'status' => 200,
                'brand' => $marca
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
            $tiendas = array();

            foreach ($marca->tiendas as $tienda) {
                array_push($tiendas, array(
                    "id" => $tienda->id,
                    "name" => $tienda->name,
                    "latitude" => $tienda->latitude,
                    "longitude" => $tienda->longitude,
                    "active" => $tienda->active,
                    "brand_id" => $tienda->marca_id,
                    "date_created" => $tienda->created_at
                ));
            }

            return response()->json([
                'status' => 200,
                'stores' => $tiendas
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
        $response = new Marca();
        $response->name = $request->all()['name'];
        $response->description = $request->all()['description'];
        $response->logo_url = $request->all()['logo_url'];
        $response->banner_url = $request->all()['banner_url'];
        $response->active = $request->all()['active'];
        $response->save();
        
        $marca = array(
            "id" => $response->id,
            "name" => $response->name,
            "description" => $response->description,
            "logo_url" => $response->logo_url,
            "banner_url" => $response->banner_url,
            "active" => $response->active,
            "date_created" => $response->created_at
        );

        Broker::notify('brand-created', array(
          'brand' => $marca
        ));

        return response()->json([
            'status' => 200,
            'brand' => $marca
        ]);
    }

    public function update(Request $request, $marca_id)
    {
        try {
            $response = Marca::findOrFail($marca_id);

            $response->name = $request->all()['name'];
            $response->description = $request->all()['description'];
            $response->logo_url = $request->all()['logo_url'];
            $response->banner_url = $request->all()['banner_url'];
            $response->active = $request->all()['active'];
            $response->save();

            $marca = array(
                "id" => $response->id,
                "name" => $response->name,
                "description" => $response->description,
                "logo_url" => $response->logo_url,
                "banner_url" => $response->banner_url,
                "active" => $response->active,
                "date_created" => $response->created_at
            );

            Broker::notify('brand-updated', array(
              'brand' => $marca
            ));

            return response()->json([
                'status' => 200,
                'brand' => $marca
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
            $response = Marca::findOrFail($marca_id);

            $marca = array(
                "id" => $response->id,
                "name" => $response->name,
                "description" => $response->description,
                "logo_url" => $response->logo_url,
                "banner_url" => $response->banner_url,
                "active" => $response->active,
                "date_created" => $response->created_at
            );

            $response->delete();

            Broker::notify('brand-deleted', array(
              'brand' => $marca
            ));

            return response()->json([
                'status' => 200,
                'brand' => $marca
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }
}
