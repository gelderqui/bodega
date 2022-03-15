<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $proveedores = Proveedor::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $proveedores = Proveedor::where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('id', 'desc')->paginate(3);
        }

        return [
            'pagination' => [
                'total'        => $proveedores->total(),
                'current_page' => $proveedores->currentPage(),
                'per_page'     => $proveedores->perPage(),
                'last_page'    => $proveedores->lastPage(),
                'from'         => $proveedores->firstItem(),
                'to'           => $proveedores->lastItem(),
            ],
            'proveedores' => $proveedores
        ];
    }
    public function store(Request $request)
    {
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->contacto =$request->contacto;
        $proveedor->telefono = $request->telefono;
        $proveedor->condicion=1;
        $proveedor->save();
    }
    public function update(Request $request)
    {
        $proveedor = Proveedor::findOrFail($request->id);
        $proveedor->nombre = $request->nombre;
        $proveedor->contacto =$request->contacto;
        $proveedor->telefono = $request->telefono;
        $proveedor->condicion = '1';
        $proveedor->save();
    }
    public function desactivar(Request $request)
    {
        $proveedor = Proveedor::findOrFail($request->id);
        $proveedor->condicion = '0';
        $proveedor->save();
    }

    public function activar(Request $request)
    {
        $proveedor = Proveedor::findOrFail($request->id);
        $proveedor->condicion = '1';
        $proveedor->save();
    }
}
