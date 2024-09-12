<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Empleado;


class AuthController extends Controller
{
   public function register(Request $request){
        $validator = Validator::make($request->all(),[
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

        $empleados =Empleado::create([
            'nombre'=> $request->nombre,
            'rol'=>$request->rol,
            'salario'=>$request->salario
        ]);
   }
}
