<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicio = Servicio::all();

        $data =[
            'clientas'=> $servicio
        ];

        return response()->json($data,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nombre'=> 'required|string|max:50',
            'descripcion'=>'nullable|string|max:200',
            'precio'=>'required|numeric'
        ]);

        if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de los datos',
                'error'=>$validator->errors()
            ];

            return response()->json($data,400);
        }

        $servicio = Servicio::create([
            'nombre'=> $request->nombre,
            'descripcion'=>$request->descripcion,
            'precio'=>$request->precio
        ]);

        if (!$servicio) {
            $data =[
                'message'=>'Error al crear servicios'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'clienta'=> $servicio
        ];

        return response()->json($data, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            $data = [
                'message'=>'servicio no encontrada'
            ];

            return response()->json($data, 400);
        }

        $data = [
            'clienta'=>$servicio
        ];
        return response()->json($data,200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            $data = [
                'message'=>'servicio no encontrada'
            ];

            return response()->json($data, 400);
        }

        $validator= Validator::make($request->all(),[
            'nombre'=> 'required|string|max:50',
            'descripcion'=>'nullable|string|max:200',
            'precio'=>'required|numeric'
        ]);

        if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de los datos',
                'error'=>$validator->errors()
            ];

            return response()->json($data,400);
        }
            
            $servicio->nombre= $request->nombre;
            $servicio->descripcion = $request->descripcion;
            $servicio->precio = $request->precio;

            $servicio->save();

            $data= [
                'message'=>'servicio actualizada correctamente'
            ];

            return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            $data = [
                'message'=>'servicio no encontrada'
            ];

            return response()->json($data, 400);
        }

        $servicio->delete();

        $data = [
            'message'=>'servicio eliminada exitosamente'
        ];

        return response()->json($data, 200);
    }
}
