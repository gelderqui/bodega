<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Detalle;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    public function index(REquest $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $facturas = Factura::select('facturas.*','users.nombre as nombre_usuario','proveedores.nombre as nombre_proveedor',
            DB::raw("DATE_FORMAT(facturas.created_at,'%d-%m-%Y') AS factura_created_at"))
            ->join('users','users.id','=','facturas.idusuario')
            ->join('proveedores','proveedores.id','=','facturas.idproveedor')
            ->where('facturas.condicion',1)
            ->orderBy('facturas.id','desc')->paginate(10);
        }
        else{
            $facturas = Factura::select('facturas.*','users.nombre as nombre_usuario','proveedores.nombre as nombre_proveedor',
            DB::raw("DATE_FORMAT(facturas.created_at,'%d-%m-%Y') AS factura_created_at"))
            ->join('users','users.id','=','facturas.idusuario')
            ->join('proveedores','proveedores.id','=','facturas.idproveedor')
            ->where('facturas.condicion',1)
            ->where('facturas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('facturas.id','desc')->paginate(10);
        }

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
    public function obtenerCabecera(Request $request){
        //if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        // $id=1;

        $factura = Factura::select('facturas.id','facturas.numero','facturas.serie',
        'facturas.total','facturas.descuento_nota','facturas.flete','facturas.condicion','facturas.created_at',
        DB::raw("DATE_FORMAT(facturas.created_at,'%d-%m-%Y') AS factura_created_at"),
        'proveedores.nombre','users.usuario')
        ->join('proveedores','facturas.idproveedor','=','proveedores.id')
        ->join('users','facturas.idusuario','=','users.id')
        ->where('facturas.id','=',$id)
        ->orderBy('facturas.id', 'desc')->first();

        return ['factura' => $factura];
    }
    public function obtenerDetalles(Request $request){
        //if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        // $id=1;
        $detalles = Detalle::select('detalles.cantidad','detalles.precio','productos.nombre as producto')
        ->join('productos','detalles.idproducto','=','productos.id')
        ->where('detalles.idfactura','=',$id)
        ->orderBy('detalles.id', 'desc')->get();
        return ['detalles' => $detalles];
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();

            $factura = new Factura();
            $factura->idproveedor = $request->idproveedor;
            // $factura->idusuario = \Auth::user()->id;
            $factura->idusuario = 1;
            $factura->numero = $request->numero;
            $factura->serie = $request->serie;
            $factura->total = $request->total;
            $factura->total_parcial = $request->totalparcial;
            $factura->descuento_nota= $request->descuento;
            $factura->flete = $request->flete;
            $factura->condicion = 1;
            $factura->save();

            $detalles = $request->data;//Array de detalles
            //Recorrer todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new Detalle();
                $detalle->idfactura = $factura->id;
                $detalle->idproducto = $det['idProducto'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->precio = $det['precio'];
                // $detalle->descuento = $det['descuento'];
                $detalle->save();
            }
            DB::commit();
            return [
                'id' => $factura->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}
