<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['descricao', 'obs', 'unidade_id', 'paciente_id', 'profissional_id'];


    public function unidade()
    {
        return $this->belongsTo('App\Unidade');
    }

    public function paciente()
    {
        return $this->belongsTo('App\Paciente');
    }

    public function profissional()
    {
        return $this->belongsTo('App\Profissional');
    }

    public function produto()
    {
        return $this->belongsToMany('App\Produto');
    }

}
