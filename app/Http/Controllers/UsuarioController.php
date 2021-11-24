<?php

namespace App\Http\Controllers;

use App\Models\Usuario as Usuario;
use App\Http\Resources\Usuario as UsuarioResource;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(){
        $usuario = Usuario::paginate(15);
        return UsuarioResource::collection($usuario);
      }
    
      public function show($id){
        $usuario = Usuario::findOrFail( $id );
        return new UsuarioResource( $usuario );
      }
    
      public function store(Request $request){
        $usuario = new Usuario;
        $usuario->email = $request->input('email');
        $usuario->descricao = $request->input('descricao');
    
        if( $usuario->save() ){
          return new UsuarioResource( $usuario );
        }
      }
    
       public function update(Request $request){
        $usuario = Usuario::findOrFail( $request->id );
        $usuario->email = $request->input('email');
        $usuario->descricao = $request->input('descricao');
    
        if( $usuario->save() ){
          return new UsuarioResource( $usuario );
        }
      } 
    
      public function destroy($id){
        $usuario = Usuario::findOrFail( $id );
        if( $usuario->delete() ){
          return new UsuarioResource( $usuario );
        }
    }
}
