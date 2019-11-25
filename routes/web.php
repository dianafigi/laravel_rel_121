<?php

use App\Cliente;
use App\Endereco;

Route::get('/clientes', function () {
    $clientes = Cliente::all();
    foreach($clientes as $c) {
      echo "<p>ID: " . $c->id . "</p>";
      echo "<p>Nome: " . $c->nome . "</p>";
      echo "<p>Telefone: " . $c->telefone . "</p>";

      // $e = Endereco::where('cliente_id', $c->id)->first();   //metodo mais arcaico. A melhor forma é a de baixo, utilizada ao mm tempo que o model Cliente. Usar hasOne()
      // echo "<p>Rua: " . $e->rua . "</p>";
      // echo "<p>Número: " . $e->numero . "</p>";
      // echo "<p>Bairro: " . $e->bairro . "</p>";
      // echo "<p>UF: " . $e->uf . "</p>";
      // echo "<p>CEP: " . $e->cep . "</p>";
      // echo "<p>Cidade: " . $e->cidade . "</p>";

      echo "<p>Rua: " . $c->endereco->rua . "</p>";  //endereco é a funçao q está no model
      echo "<p>Número: " . $c->endereco->numero . "</p>";
      echo "<p>Bairro: " . $c->endereco->bairro . "</p>";
      echo "<p>UF: " . $c->endereco->uf . "</p>";
      echo "<p>CEP: " . $c->endereco->cep . "</p>";
      echo "<p>Cidade: " . $c->endereco->cidade . "</p>";
      echo "<hr>";
    }
});

Route::get('/enderecos', function () {
  $enderecos = Endereco::all();
  foreach($enderecos as $e) {
    echo "<p>ID do Cliente: " . $e->cliente_id . "</p>";

    echo "<p>Nome: " . $e->cliente->nome . "</p>"; //aqui faço parecido a lá em cima, mas ao contrario. Criei no model Endereco a ligaçao com o cliente. Usar belongsTo()
    echo "<p>Telefone: " . $e->cliente->telefone . "</p>";

    echo "<p>Rua: " . $e->rua . "</p>";
    echo "<p>Número: " . $e->numero . "</p>";
    echo "<p>Bairro: " . $e->bairro . "</p>";
    echo "<p>UF: " . $e->uf . "</p>";
    echo "<p>CEP: " . $e->cep . "</p>";
    echo "<p>Cidade: " . $e->cidade . "</p>";
    echo "<hr>";
  }
});

Route::get('/inserir', function() {
  $c = new Cliente();
  $c->nome = "José Almeida";
  $c->telefone = "934554123";
  $c->save();

  $e = new Endereco();
  $e->rua = "Av. Marques de Tomar";
  $e->numero = 1;
  $e->bairro = "Saldanha";
  $e->uf = "OP";
  $e->cep = "9658-258";
  $e->cidade = "Porto";

  // $e->cliente_id = $c->id;  Alternativa menos usada. Usar a de baixo.

  $c->endereco()->save($e); //guardar o $e dentro do $c usando a funçao que os relaciona 'endereco'


  $c = new Cliente();
  $c->nome = "Luisa Badum";
  $c->telefone = "2158796352";
  $c->save();

  $e = new Endereco();
  $e->rua = "Av. Abreu";
  $e->numero = 8;
  $e->bairro = "Azul";
  $e->uf = "AL";
  $e->cep = "1234-567";
  $e->cidade = "Almada";

  $c->endereco()->save($e);
});

Route::get('/clientes/json', function() {
  // $clientes = Cliente::all();  Se eu utilizar esta, vai apenas mostrar o que está na tabela dos clientes
  $clientes = Cliente::with(['endereco'])->get(); //assim faz a relaçao entre as duas tabelas e vai mostrar tudo. Se tivesse outro hasOne() pra pe telefone ficava: $clientes = Cliente::with(['endereco', 'telefone'])->get(); Isto significava q tinha uma tabela so para 'telefone'. este 'endereco' é a funcao q está no model!
  return $clientes->toJson();
});

Route::get('/enderecos/json', function() {
  $enderecos = Endereco::with(['cliente'])->get();
  return $enderecos->toJson();
});
