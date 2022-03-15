<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;

class UsuarioController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $users = User::leftJoin('roles','users.idrol','=','roles.id')
            ->select('users.id','users.idrol','users.nombre as nombre_usuario','users.usuario','users.condicion','roles.nombre as nombre_rol')
            ->orderBy('users.id', 'desc')->paginate(5);
        }
        else{
            $users = User::join('roles','users.idrol','=','roles.id')
            ->select('users.id','users.idrol','users.nombre as nombre_usuario','users.usuario','users.condicion','roles.nombre as nombre_rol')
            ->where('users.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('users.id', 'desc')->paginate(5);
        }

        return [
            'pagination' => [
                'total'        => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),
            ],
            'users' => $users
        ];
    }
    public function store(Request $request)
    {
        $user = new User();
        $user->idrol = $request->idrol;
        $user->nombre = $request->nombre;
        $user->usuario = $request->usuario;
        $user->password = bcrypt( $request->password);
        $user->condicion = '1';
        $user->save();
    }
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->idrol = $request->idrol;
        $user->nombre = $request->nombre;
        $user->usuario = $request->usuario;
        if($request->boolUsuario){
            // $user->password = $request->password;
            $user->password = bcrypt( $request->password);
        }
        $user->condicion = '1';
        $user->save();
    }
    public function desactivar(Request $request)
    {
        $usuario = User::findOrFail($request->id);
        $usuario->condicion = '0';
        $usuario->save();
    }
    public function activar(Request $request)
    {
        $usuario = User::findOrFail($request->id);
        $usuario->condicion = '1';
        $usuario->save();
    }
    public function selectRol(){
        $roles=Rol::where('condicion', '=', '1')
        ->select('id','nombre')
        ->orderBy('nombre', 'asc')->get();

        return ['roles'=>$roles];

    }

}
