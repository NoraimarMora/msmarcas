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
        $cuentaB->beneficiario = $request->all()['beneficiario'];
        $cuentaB->tipo_dni = $request->all()['tipo_dni'];
        $cuentaB->dni = $request->all()['dni'];
        $cuentaB->num_cuenta = $request->all()['num_cuenta'];
        $cuentaB->tipo_cuenta = $request->all()['tipo_cuenta'];
        $cuentaB->tienda_id = $request->all()['tienda_id'];
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

            $cuentaB->beneficiario = $request->all()['beneficiario'];
            $cuentaB->tipo_dni = $request->all()['tipo_dni'];
            $cuentaB->dni = $request->all()['dni'];
            $cuentaB->num_cuenta = $request->all()['num_cuenta'];
            $cuentaB->tipo_cuenta = $request->all()['tipo_cuenta'];
            $cuentaB->tienda_id = $request->all()['tienda_id'];
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
