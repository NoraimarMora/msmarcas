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
            $response = Horario::findOrFail($horario_id);

            $horario = array(
                "id" => $response->id,
                "day" => $response->day,
                "open" => $response->open,
                "close" => $response->close,
                "store_id" => $response->tienda_id,
                "date_created" => $response->created_at
            );

            return response()->json([
                'status' => 200,
                'schedule' => $horario
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
        $response = new Horario();
        $response->day = $request->all()['day'];
        $response->open = $request->all()['open'];
        $response->close = $request->all()['close'];
        $response->tienda_id = $request->all()['tienda_id'];
        $response->save();

        $horario = array(
            "id" => $response->id,
            "day" => $response->day,
            "open" => $response->open,
            "close" => $response->close,
            "store_id" => $response->tienda_id,
            "date_created" => $response->created_at,
        );

        return response()->json([
            'status' => 200,
            'schedule' => $horario
        ]);
    }

    public function update(Request $request, $horario_id)
    {
        try {
            $response = Horario::findOrFail($horario_id);

            $response->day = $request->all()['day'];
            $response->open = $request->all()['open'];
            $response->close = $request->all()['close'];
            $response->tienda_id = $request->all()['tienda_id'];
            $response->save();

            $horario = array(
                "id" => $response->id,
                "day" => $response->day,
                "open" => $response->open,
                "close" => $response->close,
                "store_id" => $response->tienda_id,
                "date_created" => $response->created_at,
            );

            return response()->json([
                'status' => 200,
                'schedule' => $horario
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
            $response = Horario::findOrFail($horario_id);

            $horario = array(
                "id" => $response->id,
                "day" => $response->day,
                "open" => $response->open,
                "close" => $response->close,
                "store_id" => $response->tienda_id,
                "date_created" => $response->created_at,
            );

            $response->delete();

            return response()->json([
                'status' => 200,
                'schedule' => $horario
            ]);
        } catch(ModelNotFoundException $exception) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ]);
        }
    }
}
