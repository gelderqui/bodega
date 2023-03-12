<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controller\Redirect;
use App\Models\Producto;
use App\Models\Precio;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        // dd('entra');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        $precios=DB::table('precios')
        ->select('idproducto','precio')
        ->where('condicion','=',1);
        //Se hace la subquery porque un producto puede estar sin precio y tambien un producto puede tener varios precio pero solo uno activo
        if ($buscar==''){
            $productos=DB::table('productos')
            ->select('productos.id','productos.nombre','productos.cantidad','productos.condicion','precios.precio as precio_precio')
            ->leftjoinSub($precios,'precios',function($leftjoin){
                $leftjoin->on('productos.id','=','precios.idproducto');
            })
            ->orderBy('productos.id','desc')->paginate(10);
        }else{
            $productos=DB::table('productos')
            ->select('productos.id','productos.nombre','productos.cantidad','productos.condicion','precios.precio as precio_precio')
            ->leftjoinSub($precios,'precios',function($leftjoin){
                $leftjoin->on('productos.id','=','precios.idproducto');
            })
            ->where('productos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('productos.id','desc')->paginate(10);
        }
        return
        [
            'pagination' => [
                'total'        => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page'     => $productos->perPage(),
                'last_page'    => $productos->lastPage(),
                'from'         => $productos->firstItem(),
                'to'           => $productos->lastItem(),
            ],
            'productos' => $productos
        ];
    }

    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->cantidad =$request->cantidad;
        $producto->condicion=1;
        $producto->save();

        if($request->boolprecio){
            $precio = new Precio();
            $precio->idproducto=$producto->id;
            $precio->precio = $request->precio;
            $precio->descripcion = 'Ingreso nuevo producto No:1';
            $precio->save();
        }
    }
    public function update(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->nombre = $request->nombre;
        $producto->cantidad = $request->cantidad;
        $producto->condicion = '1';
        $producto->save();

        //Cuento cuantos precios tiene el producto, si existen registros siempre hay un solo registro activo "1"
        $contarPrecios=Precio::where('idproducto','=',$request->id)->count();

        if($contarPrecios!=0){
            //Busco el ultimo precio del producto
            $idActualizar=Precio::select('id')
            ->where('idproducto','=',$request->id)
            ->orderBy('id','desc')->first();
            //Desactivo el ultimo precio del producto
            $precio = Precio::findOrFail($idActualizar->id);
            $precio->condicion = '0';
            $precio->save();
        }

        if($request->boolprecio){
            $precio = new Precio();
            $precio->idproducto = $producto->id;
            $precio->precio = $request->precio;
            $precio->descripcion = 'Ingreso al actualizar producto No:'.$contarPrecios+1;
            $precio->save();
        }

    }
    public function desactivar(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->condicion = '0';
        $producto->save();
    }

    public function activar(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->condicion = '1';
        $producto->save();
    }

    public function selectProducto(Request $request){
        //if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $productos = Producto::where('nombre', 'like', '%'. $filtro . '%')
        ->where('condicion',1)
        ->select('id','nombre')
        ->orderBy('nombre', 'asc')->get();

        return ['productos' => $productos];
    }
}
