<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clienta;
use Illuminate\Support\Facades\Validator;

class ClientaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientas = Clienta::all();

        $data =[
            'clientas'=> $clientas
        ];

        return response()->json($data,200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validator= Validator::make($request->all(),[
            'nombre'=> 'required|string|max:50',
            'fecha_nacimiento'=>'required|date',
            'correo'=>'required|string|email|max:255|unique:clientas',
            'contraseña'=>'required|string|min:6'
        ]);

        if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de los datos',
                'error'=>$validator->errors()
            ];

            return response()->json($data,400);
        }


        $clienta = Clienta::create([
            'nombre'=> $request->nombre,
            'fecha_nacimiento'=>$request->fecha_nacimiento,
            'correo'=>$request->correo,
            'contraseña'=>$request->contraseña
        ]);

        if (!$clienta) {
            $data =[
                'message'=>'Error al crear clientas'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'clienta'=> $clienta
        ];

        return response()->json($data, 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $clienta = Clienta::find($id);

        if (!$clienta) {
            $data = [
                'message'=>'clienta no encontrada'
            ];

            return response()->json($data, 400);
        }

        $data = [
            'clienta'=>$clienta
        ];
        return response()->json($data,200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $clienta = Clienta::find($id);

        if (!$clienta) {
            $data = [
                'message'=>'clienta no encontrada'
            ];

            return response()->json($data, 400);
        }

        $validator= Validator::make($request->all(),[
            'nombre'=> 'required|string|max:50',
            'fecha_nacimiento'=>'required|date',
            'correo'=>'required|string|email|max:255',
            'contraseña'=>'required|string|min:6'
        ]);

        if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de los datos',
                'error'=>$validator->errors()
            ];

            return response()->json($data,400);
        }

            $clienta->nombre= $request->nombre;
            $clienta->fecha_nacimiento = $request->fecha_nacimiento;
            $clienta->correo = $request->correo;
            $clienta->contraseña = $request->contraseña;

            $clienta->save();

            $data= [
                'message'=>'clienta actualizada correctamente'
            ];

            return response()->json($data,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clienta = Clienta::find($id);

        if (!$clienta) {
            $data = [
                'message'=>'clienta no encontrada'
            ];

            return response()->json($data, 400);
        }

        $clienta->delete();

        $data = [
            'message'=>'clienta eliminada exitosamente'
        ];

        return response()->json($data, 200);
    }
}
