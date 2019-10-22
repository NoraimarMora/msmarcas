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
        $response = Tienda::all();
        $tiendas = array();

        foreach($response as $tienda) {
            $cuentas = array();
            $horarios = array();

            foreach ($tienda->cuentasBancarias as $cuenta) {
                array_push($cuentas, array(
                    "id" => $cuenta->id,
                    "beneficiary" => $cuenta->beneficiary,
                    "dni_type" => $cuenta->dni_type,
                    "dni" => $cuenta->dni,
                    "account_number" => $cuenta->account_number,
                    "account_type" => $cuenta->account_type,
                    "bank" => $cuenta->bank,
                    "owner_id" => $cuenta->tienda_id,
                    "date_created" => $cuenta->created_at,
                ));
            }

            foreach ($tienda->horarios as $horario) {
                array_push($horarios, array(
                    "id" => $horario->id,
                    "day" => $horario->day,
                    "open" => $horario->open,
                    "close" => $horario->close,
                    "store_id" => $horario->tienda_id,
                    "date_created" => $horario->created_at
                ));
            }

            array_push($tiendas, array(
                "id" => $tienda->id,
                "name" => $tienda->name,
                "latitude" => $tienda->latitude,
                "longitude" => $tienda->longitude,
                "active" => $tienda->active,
                "brand_id" => $tienda->marca_id,
                "date_created" => $tienda->created_at,
                "brand" => $tienda->marca,
                "accounts" => $cuentas,
                "schedules" => $horarios
            ));
        }

        return response()->json([
            'status' => 200,
            'stores' => $tiendas
        ]);
    }

    public function getActive()
    {
        $response = Tienda::where('active', 1)->get();
        $tiendas = array();

        foreach($response as $tienda) {
            $cuentas = array();
            $horarios = array();

            foreach ($tienda->cuentasBancarias as $cuenta) {
                array_push($cuentas, array(
                    "id" => $cuenta->id,
                    "beneficiary" => $cuenta->beneficiary,
                    "dni_type" => $cuenta->dni_type,
                    "dni" => $cuenta->dni,
                    "account_number" => $cuenta->account_number,
                    "account_type" => $cuenta->account_type,
                    "bank" => $cuenta->bank,
                    "owner_id" => $cuenta->tienda_id,
                    "date_created" => $cuenta->created_at,
                ));
            }

            foreach ($tienda->horarios as $horario) {
                array_push($horarios, array(
                    "id" => $horario->id,
                    "day" => $horario->day,
                    "open" => $horario->open,
                    "close" => $horario->close,
                    "store_id" => $horario->tienda_id,
                    "date_created" => $horario->created_at
                ));
            }

            array_push($tiendas, array(
                "id" => $tienda->id,
                "name" => $tienda->name,
                "latitude" => $tienda->latitude,
                "longitude" => $tienda->longitude,
                "active" => $tienda->active,
                "brand_id" => $tienda->marca_id,
                "date_created" => $tienda->created_at,
                "brand" => $tienda->marca,
                "accounts" => $cuentas,
                "schedules" => $horarios
            ));
        }

        return response()->json([
            'status' => 200,
            'stores' => $tiendas
        ]);
    }

    public function getById($tienda_id)
    {
        try {
            $response = Tienda::findOrFail($tienda_id);
            $cuentas = array();
            $horarios = array();

            foreach ($response->cuentasBancarias as $cuenta) {
                array_push($cuentas, array(
                    "id" => $cuenta->id,
                    "beneficiary" => $cuenta->beneficiary,
                    "dni_type" => $cuenta->dni_type,
                    "dni" => $cuenta->dni,
                    "account_number" => $cuenta->account_number,
                    "account_type" => $cuenta->account_type,
                    "bank" => $cuenta->bank,
                    "owner_id" => $cuenta->tienda_id,
                    "date_created" => $cuenta->created_at,
                ));
            }

            foreach ($response->horarios as $horario) {
                array_push($horarios, array(
                    "id" => $horario->id,
                    "day" => $horario->day,
                    "open" => $horario->open,
                    "close" => $horario->close,
                    "store_id" => $horario->tienda_id,
                    "date_created" => $horario->created_at
                ));
            }

            $tienda = array(
                "id" => $response->id,
                "name" => $response->name,
                "latitude" => $response->latitude,
                "longitude" => $response->longitude,
                "active" => $response->active,
                "brand_id" => $response->marca_id,
                "date_created" => $response->created_at,
                "brand" => $response->marca,
                "accounts" => $cuentas,
                "schedules" => $horarios
            );

            return response()->json([
                'status' => 200,
                'store' => $tienda
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }        
    }

    public function getCuentasByTiendaId($tienda_id)
    {
        try {
            $tienda = Tienda::findOrFail($tienda_id);
            $cuentas = array();

            foreach ($tienda->cuentasBancarias as $cuenta) {
                array_push($cuentas, array(
                    "id" => $cuenta->id,
                    "beneficiary" => $cuenta->beneficiary,
                    "dni_type" => $cuenta->dni_type,
                    "dni" => $cuenta->dni,
                    "account_number" => $cuenta->account_number,
                    "account_type" => $cuenta->account_type,
                    "bank" => $cuenta->bank,
                    "owner_id" => $cuenta->tienda_id,
                    "date_created" => $cuenta->created_at,
                ));
            }
            
            return response()->json([
                'status' => 200,
                'accounts' => $cuentas
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }

    public function getHorariosByTiendaId($tienda_id)
    {
        try {
            $tienda = Tienda::findOrFail($tienda_id);
            $horarios = array();

            foreach ($tienda->horarios as $horario) {
                array_push($horarios, array(
                    "id" => $horario->id,
                    "day" => $horario->day,
                    "open" => $horario->open,
                    "close" => $horario->close,
                    "store_id" => $horario->tienda_id,
                    "date_created" => $horario->created_at
                ));
            }

            return response()->json([
                'status' => 200,
                'schedules' => $horarios
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
        $response = new Tienda();
        $response->name = $request->all()['name'];
        $response->latitude = $request->all()['latitude'];
        $response->longitude = $request->all()['longitude'];
        $response->marca_id = $request->all()['marca_id'];
        $response->save();

        $tienda = array(
            "id" => $response->id,
            "name" => $response->name,
            "latitude" => $response->latitude,
            "longitude" => $response->longitude,
            "active" => $response->active,
            "brand_id" => $response->marca_id,
            "date_created" => $response->created_at
        );

        // TODO: publish `store-created`

        return response()->json([
            'status' => 200,
            'store' => $tienda
        ]);
    }

    public function update(Request $request, $tienda_id)
    {
        try {
            $response = Tienda::findOrFail($tienda_id);

            $response->name = $request->all()['name'];
            $response->latitude = $request->all()['latitude'];
            $response->longitude = $request->all()['longitude'];
            $response->marca_id = $request->all()['marca_id'];
            $response->save();

            $tienda = array(
                "id" => $response->id,
                "name" => $response->name,
                "latitude" => $response->latitude,
                "longitude" => $response->longitude,
                "active" => $response->active,
                "brand_id" => $response->marca_id,
                "date_created" => $response->created_at
            );

            // TODO: publish `store-updated`

            return response()->json([
                'status' => 200,
                'store' => $tienda
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }

    public function destroy($tienda_id)
    {
        try {
            $response = Tienda::findOrFail($tienda_id);

            $tienda = array(
                "id" => $response->id,
                "name" => $response->name,
                "latitude" => $response->latitude,
                "longitude" => $response->longitude,
                "active" => $response->active,
                "brand_id" => $response->marca_id,
                "date_created" => $response->created_at
            );

            $response->delete();

            // TODO: publish `store-deleted`

            return response()->json([
                'status' => 200,
                'store' => $tienda
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }
}
