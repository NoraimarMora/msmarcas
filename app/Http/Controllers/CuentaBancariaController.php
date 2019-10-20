<?php

namespace App\Http\Controllers;

use App\CuentaBancaria;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CuentaBancariaController extends Controller
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

    public function getById($cuentaB_id)
    {
        try {
            $response = CuentaBancaria::findOrFail($cuentaB_id);

            $cuentaB = array(
                "id" => $response->id,
                "beneficiary" => $response->beneficiary,
                "dni_type" => $response->dni_type,
                "dni" => $response->dni,
                "account_number" => $response->account_number,
                "account_type" => $response->account_type,
                "bank" => $response->bank,
                "owner_id" => $response->tienda_id,
                "date_created" => $response->created_at,
            );

            return response()->json([
                'status' => 200,
                'account' => $cuentaB
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
        $response = new CuentaBancaria();
        $response->beneficiary = $request->all()['beneficiary'];
        $response->dni_type = $request->all()['dni_type'];
        $response->dni = $request->all()['dni'];
        $response->account_number = $request->all()['account_number'];
        $response->account_type = $request->all()['account_type'];
        $response->tienda_id = $request->all()['tienda_id'];
        $response->save();

        $cuentaB = array(
            "id" => $response->id,
            "beneficiary" => $response->beneficiary,
            "dni_type" => $response->dni_type,
            "dni" => $response->dni,
            "account_number" => $response->account_number,
            "account_type" => $response->account_type,
            "bank" => $response->bank,
            "owner_id" => $response->tienda_id,
            "date_created" => $response->created_at,
        );

        return response()->json([
            'status' => 200,
            'account' => $cuentaB
        ]);
    }

    public function update(Request $request, $cuentaB_id)
    {
        try {
            $response = CuentaBancaria::findOrFail($cuentaB_id);

            $response->beneficiary = $request->all()['beneficiary'];
            $response->dni_type = $request->all()['dni_type'];
            $response->dni = $request->all()['dni'];
            $response->account_number = $request->all()['account_number'];
            $response->account_type = $request->all()['account_type'];
            $response->tienda_id = $request->all()['tienda_id'];
            $response->save();

            $cuentaB = array(
                "id" => $response->id,
                "beneficiary" => $response->beneficiary,
                "dni_type" => $response->dni_type,
                "dni" => $response->dni,
                "account_number" => $response->account_number,
                "account_type" => $response->account_type,
                "bank" => $response->bank,
                "owner_id" => $response->tienda_id,
                "date_created" => $response->created_at,
            );

            return response()->json([
                'status' => 200,
                'account' => $cuentaB
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }

    public function destroy($cuentaB_id)
    {
        try {
            $response = CuentaBancaria::findOrFail($cuentaB_id);

            $cuentaB = array(
                "id" => $response->id,
                "beneficiary" => $response->beneficiary,
                "dni_type" => $response->dni_type,
                "dni" => $response->dni,
                "account_number" => $response->account_number,
                "account_type" => $response->account_type,
                "bank" => $response->bank,
                "owner_id" => $response->tienda_id,
                "date_created" => $response->created_at,
            );

            $response->delete();

            return response()->json([
                'status' => 200,
                'account' => $cuentaB
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }
}
