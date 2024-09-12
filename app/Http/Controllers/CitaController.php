<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Cita;

class CitaController extends Controller
{
    
    public function index()
    {
        $citas = Cita::with(['clienta','servicio'])->get();

        //se mapea la coleccion para la inclucion de los nombres
        $data = $citas->map(function($cita){
            return [
                'id'=>$cita->id,
                'clienta'=>$cita->clienta->nombre,
                'servicio'=>$cita->servicio->nombre,
                'fecha'=>$cita->fecha,
                'hora'=>$cita->hora,
            ];
        });

        return response()->json(['citas'=>$data],200);
    }

    
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
           'clienta_id'=>'required|exists:clientas,id',
            'servicio_id'=>'required|exists:servicios,id',
            'fecha'=>'required|date',
            'hora'=>'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de los datos',
                'error'=>$validator->errors()
            ];

            return response()->json($data,400);
        }


        $cita = Cita::create([
            'clienta_id'=> $request->clienta_id,
            'servicio_id'=>$request->servicio_id,
            'fecha'=>$request->fecha,
            'hora'=>$request->hora
        ]);

        if (!$cita) {
            $data =[
                'message'=>'Error al crear citas'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'cita'=> $cita
        ];

        return response()->json($data, 201);
    }

    
    public function show(string $id)
    {
        // Cargar las relaciones clienta y servicio
        $cita = Cita::with(['clienta', 'servicio'])->find($id);

        if (!$cita) {
            return response()->json(['message' => 'Cita no encontrada'], 400);
        }

        $data = [
            'id' => $cita->id,
            'clienta' => $cita->clienta->nombre, 
            'servicio' => $cita->servicio->nombre, 
            'fecha' => $cita->fecha,
            'hora' => $cita->hora,
        ];

        return response()->json(['cita' => $data], 200);
    }

    
    public function update(Request $request, string $id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            $data = [
                'message'=>'cita no encontrada'
            ];

            return response()->json($data, 400);
        }

        $validator= Validator::make($request->all(),[
            'clienta_id'=>'required|exists:clientas,id',
            'servicio_id'=>'required|exists:servicios,id',
            'fecha'=>'required|date',
            'hora'=>'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de los datos',
                'error'=>$validator->errors()
            ];

            return response()->json($data,400);
        }

            $cita->clienta_id= $request->clienta_id;
            $cita->servicio_id = $request->servicio_id;
            $cita->fecha = $request->fecha;
            $cita->hora = $request->hora;

            $cita->save();

            $data= [
                'message'=>'cita actualizada correctamente'
            ];

            return response()->json($data,200);
    }

   
    public function destroy(string $id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            $data = [
                'message'=>'cita no encontrada'
            ];

            return response()->json($data, 400);
        }

        $cita->delete();

        $data = [
            'message'=>'cita eliminada exitosamente'
        ];

        return response()->json($data, 204);
    }
}
