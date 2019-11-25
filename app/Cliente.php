<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function endereco() {
      return $this->hasOne('App\Endereco', 'cliente_id', 'id'); //neste caso n era necessario especificar 'cliente_id', 'id', podia ficar ('App\Endereco') pq estou a seguir a nomenclatura do lavarel usando 'id' e 'cliente_id' e portanto ele ja relaciona os campos automaticamente. Mas se em vez de 'cliente_id' estivesse a usar 'codigo_cliente' pe, teria de especificar.
    }
}
