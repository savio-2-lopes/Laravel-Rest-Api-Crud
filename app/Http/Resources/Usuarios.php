<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class Usuarios extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome'=> $this->nome,
            'cpf'=> $this->cpf,
            'nascimento'=> $this->nascimento,
            'email'=> $this->email,
            'celular'=> $this->celular,
            'observacao'=> $this->observacao
        ];
    }
}
