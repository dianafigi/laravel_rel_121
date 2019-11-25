<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public function cliente() {
      return $this->belongsTo('App\Cliente', 'cliente_id', 'id'); //primeiro vem a tabela interna e depois a externa. Tal como no model Cliente, posso ter de especificar ou nao 'cliente_id', 'id' consoante estiver a utilizar a nomenclatura de laravel ou nao.
    }
}
