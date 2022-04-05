<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;

class FacturaController extends Controller
{
    public function index(){
        $facturas = Factura::select('facturas.*','users.nombre as nombre_usuario','proveedores.nombre as nombre_proveedor')
        ->join('users','users.id','=','facturas.idusuario')
        ->join('proveedores','proveedores.id','=','facturas.idproveedor')
        ->orderBy('facturas.id','desc')->paginate(10);
        return [
            'pagination'=>[
                'total'        => $facturas->total(),
                'current_page' => $facturas->currentPage(),
                'per_page'     => $facturas->perPage(),
                'last_page'    => $facturas->lastPage(),
                'from'         => $facturas->firstItem(),
                'to'           => $facturas->lastItem(),
            ],
            'facturas'=>$facturas];
    }
}
