<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = ['nome', 'dtnascimento', 'cns', 'cpf', 'rua', 'numero', 'complemento', 'bairro', 'cidade', 
                           'cep', 'tel', 'cel',];

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = mb_strtoupper($value);
    }
    
}
