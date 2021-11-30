## Como executar o projeto

:book: Para acessar baixar a collection JSON do Insomnia [clique aqui](https://extensionlazuli.herokuapp.com/).

<br>

### Pré-requisitos

- [Rodando API](#api)
- [Passos criar/editar API](#register)

<br>

<a id="api"></a>

#### 🧭 Rodando a aplicação

```bash

# Clone este repositório
$ git clone https://github.com/savio-2-lopes/laravel_api.git

# Habilite o Apache e SQL
# Crie uma tabela denominada "usuarios"

```

<br>

<a id="register"></a>

#### :computer: Passos criar/editar API

```bash

# Criar projeto com nome api

$ composer create-project laravel/laravel api

# Acessar a pasta

cd api

# Crie tabela usuario no phpmyadmin
# adicione a tabela no arquivo .env e no item denominado DB_DATABASE=NOME_DO_BANCO
# Criar Migration e definir campos da tabela

$ php artisan make:migration create_usuarios_table --create=usuarios

# Acesse a pasta /database/migrations/(MAIS_ATUAL)
# Em Schema::create, adicione as tabelas atualize para a seguinte forma:

$ Schema::create('usuarios', function (Blueprint $table) {

# Adicione, também as seguintes tabelas dentro da função usuarios

$table->string('email');
$table->text('descricao');

# Criar Model e Controller
php artisan make:model Usuario
php artisan migrate
php artisan make:controller UsuarioController --resource

# Definir controller
# Dentro de app/Http/Controllers/UsuarioController.php

<?php
namespace App\Http\Controllers;
use App\Models\Usuario as Usuario;
use App\Http\Resources\Usuario as UsuarioResource;
use Illuminate\Http\Request;
class UsuarioController extends Controller
{
    public function index(){
        $usuarios = Usuario::paginate(15);
        return UsuarioResource::collection($usuarios);
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

# Criar Rotas
# Dentro da pasta /routes/api.php

<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Listar usuarios
Route::get('usuarios', [UsuarioController::class, 'index']);

// Listar usuários especifico
Route::get('usuarios/{id}', [UsuarioController::class, 'show']);

// Criar novo usuario
Route::post('usuarios', [UsuarioController::class, 'store']);

// Atualizar usuarios
Route::put('usuarios/{id}', [UsuarioController::class, 'update']);
// Delete usuarios
Route::delete('usuarios/{id}', [UsuarioController::class,'destroy']);

# Criar e definir resource

$ php artisan make:resource Usuario

# Acesse o arquivo app/Http/Resources/Usuario.php

<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class Usuario extends JsonResource {
    public function toArray($request){
        return [
          'id' => $this->id,
          'email' => $this->email,
          'descricao' => $this->descricao
        ];
      }
}

# Agora é só testar no Insomnia usando os seguites URLs

# Para cadastrar (POST)
$ http://localhost/api/public/api/usuarios

# Para Listar (GET)
$ http://localhost/api/public/api/usuarios

# Para Listar especifico (GET)
$ http://localhost/api/public/api/usuarios/{ID}

# Para editar (PUT)
$ http://localhost/api/public/api/usuarios/{ID}

# Para deletar (DELETE)
$ http://localhost/api/public/api/usuarios/{ID}
```
