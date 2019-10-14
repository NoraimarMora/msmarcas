<?php

namespace App\Http\Controllers;

use App\Horario;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HorarioController extends Controller
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

    public function getById($horario_id)
    {
        try {
            $horario = Horario::findOrFail($horario_id);

            return response()->json([
                'status' => 200,
                'horario' => $horario
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
        $horario = new Horario();
        $horario->day = $request->all()['day'];
        $horario->open = $request->all()['open'];
        $horario->close = $request->all()['close'];
        $horario->store_id = $request->all()['store_id'];
        $horario->save();

        return response()->json([
            'status' => 200,
            'horario' => $horario
        ]);
    }

    public function update(Request $request, $horario_id)
    {
        try {
            $horario = Horario::findOrFail($horario_id);

            $horario->day = $request->all()['day'];
            $horario->open = $request->all()['open'];
            $horario->close = $request->all()['close'];
            $horario->store_id = $request->all()['store_id'];
            $horario->save();

            return response()->json([
                'status' => 200,
                'horario' => $horario
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }

    public function destroy($horario_id)
    {
        try {
            $horario = Horario::findOrFail($horario_id);

            $horario->delete();

            return response()->json([
                'status' => 200,
                'message' => "Horario eliminada"
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }
}
