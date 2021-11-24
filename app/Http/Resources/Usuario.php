<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Usuario extends JsonResource
{
    public function toArray($request){
        return [
          'id' => $this->id,
          'email' => $this->email,
          'descricao' => $this->descricao
        ];
      }
}
