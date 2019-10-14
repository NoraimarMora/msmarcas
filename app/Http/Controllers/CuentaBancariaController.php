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
            $cuentaB = CuentaBancaria::findOrFail($cuentaB_id);

            return response()->json([
                'status' => 200,
                'cuentaB' => $tienda
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
        $cuentaB = new CuentaBancaria();
        $cuentaB->beneficiary = $request->all()['beneficiary'];
        $cuentaB->dni_type = $request->all()['dni_type'];
        $cuentaB->dni = $request->all()['dni'];
        $cuentaB->account_number = $request->all()['account_number'];
        $cuentaB->account_type = $request->all()['account_type'];
        $cuentaB->store_id = $request->all()['store_id'];
        $cuentaB->save();

        return response()->json([
            'status' => 200,
            'cuentaB' => $cuentaB
        ]);
    }

    public function update(Request $request, $cuentaB_id)
    {
        try {
            $cuentaB = CuentaBancaria::findOrFail($cuentaB_id);

            $cuentaB->beneficiary = $request->all()['beneficiary'];
            $cuentaB->dni_type = $request->all()['dni_type'];
            $cuentaB->dni = $request->all()['dni'];
            $cuentaB->account_number = $request->all()['account_number'];
            $cuentaB->account_type = $request->all()['account_type'];
            $cuentaB->store_id = $request->all()['store_id'];
            $cuentaB->save();

            return response()->json([
                'status' => 200,
                'cuentaB' => $cuentaB
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
            $cuentaB = CuentaBancaria::findOrFail($cuentaB_id);

            $cuentaB->delete();

            return response()->json([
                'status' => 200,
                'message' => "Cuenta Bancaria eliminada"
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }
}
