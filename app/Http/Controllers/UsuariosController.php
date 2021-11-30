<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Usuarios as Usuarios;
use App\Http\Resources\Usuarios as UsuariosResource;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuario=Usuarios::paginate(15);
        return UsuariosResource::collection($usuario);
    }

    public function show($id)
    {
        $usuario = Usuarios::findOrFail($id);
        return new UsuariosResource($usuario);
    }

    public function store(Request $request)
    {
        $usuario = new Usuarios;
        $usuario->nome = $request->input('nome');
        $usuario->cpf = $request->input('cpf');
        $usuario->nascimento = $request->input('nascimento');
        $usuario->email = $request->input('email');
        $usuario->celular = $request->input('celular');
        $usuario->observacao = $request->input('observacao');
        if( $usuario->save() ){
            return new UsuariosResource($usuario);
        }
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuarios::findOrFail($request->id);
        $usuario->nome = $request->input('nome');
        $usuario->cpf = $request->input('cpf');
        $usuario->nascimento = $request->input('nascimento');
        $usuario->email = $request->input('email');
        $usuario->celular = $request->input('celular');
        $usuario->observacao = $request->input('observacao');
        
        if($usuario->save()) {
            return new UsuariosResource($usuario);
        }
    }

    public function destroy($id)
    {
        $usuario = Usuarios::findOrFail($id);
        if ($usuario->delete()){
            return new UsuariosResource($usuario);
        }
    }
}
