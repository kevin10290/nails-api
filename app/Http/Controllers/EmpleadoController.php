<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleado = Empleado::all();

        $data =[
            'empleado'=> $empleado
        ];

        return response()->json($data,200);
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'nombre' => 'required|string|max:50',
            'rol' => 'required|string|max:25',
            'salario' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de los datos',
                'error'=>$validator->errors()
            ];

            return response()->json($data,400);
        }


        $empleado = Empleado::create([
            'nombre'=> $request->nombre,
            'rol'=>$request->rol,
            'salario'=>$request->salario
        ]);

        if (!$empleado) {
            $data =[
                'message'=>'Error al crear empleado'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'empleado'=> $empleado
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            $data = [
                'message'=>'empleado no encontrado'
            ];

            return response()->json($data, 400);
        }

        $data = [
            'empleado'=>$empleado
        ];
        return response()->json($data,200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            $data = [
                'message'=>'empleado no encontrado'
            ];

            return response()->json($data, 400);
        }

        $validator= Validator::make($request->all(),[
           'nombre' => 'required|string|max:50',
            'rol' => 'required|string|max:25',
            'salario' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de los datos',
                'error'=>$validator->errors()
            ];

            return response()->json($data,400);
        }

            $empleado->nombre= $request->nombre;
            $empleado->rol = $request->rol;
            $empleado->salario = $request->salario;

            $empleado->save();

            $data= [
                'message'=>'empleado actualizado correctamente'
            ];

            return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            $data = [
                'message'=>'empleado no encontrado'
            ];

            return response()->json($data, 400);
        }

        $empleado->delete();

        $data = [
            'message'=>'empleado eliminado exitosamente'
        ];

        return response()->json($data, 200);
    }
}
