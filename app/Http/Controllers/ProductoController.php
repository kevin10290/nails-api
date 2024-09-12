<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $producto = Producto::all();

        $data =[
            'producto'=> $producto
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
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de los datos',
                'error'=>$validator->errors()
            ];

            return response()->json($data,400);
        }


        $producto = Producto::create([
            'nombre'=> $request->nombre,
            'precio'=>$request->precio,
            'cantidad'=>$request->cantidad
        ]);

        if (!$producto) {
            $data =[
                'message'=>'Error al crear producto'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'producto'=> $producto
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message'=>'producto no encontrado'
            ];

            return response()->json($data, 400);
        }

        $data = [
            'producto'=>$producto
        ];
        return response()->json($data,200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message'=>'producto no encontrado'
            ];

            return response()->json($data, 400);
        }

        $validator= Validator::make($request->all(),[
           'nombre' => 'required|string|max:50',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de los datos',
                'error'=>$validator->errors()
            ];

            return response()->json($data,400);
        }

            $producto->nombre= $request->nombre;
            $producto->precio = $request->precio;
            $producto->cantidad = $request->cantidad;

            $producto->save();

            $data= [
                'message'=>'producto actualizado correctamente'
            ];

            return response()->json($data,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message'=>'producto no encontrado'
            ];

            return response()->json($data, 400);
        }

        $producto->delete();

        $data = [
            'message'=>'producto eliminado exitosamente'
        ];

        return response()->json($data, 200);
    }
}
