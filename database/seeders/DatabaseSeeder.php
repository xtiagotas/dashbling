<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlingToken;
use App\Models\Produto;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {        
        // $produto = new Produto();
        // $produto->bling_id = 'x';
        // $produto->idProdutoPai = 'x';
        // $produto->nome = 'Produto não cadastrado';
        // $produto->codigo = 'NAOCAD';
        // $produto->preco = '';
        // $produto->tipo = '';
        // $produto->situacao = '';
        // $produto->formato = '';
        // $produto->descricaoCurta = '';
        // $produto->imagemURL = '';
        // $produto->dataValidade = '';
        // $produto->unidade = '';
        // $produto->pesoLiquido = '';
        // $produto->pesoBruto = '';
        // $produto->volumes = '';
        // $produto->gtin = '';
        // $produto->gtinEmbalagem = '';
        // $produto->tipoProducao = '';
        // $produto->condicao = '';
        // $produto->freteGratis = '';
        // $produto->marca = '';
        // $produto->categoria_id = '';
        // $produto->estoque_minimo = '';
        // $produto->estoque_maximo = '';
        // $produto->estoque_crossdocking = '';
        // $produto->dimensoes_largura = '';
        // $produto->dimensoes_altura = '';
        // $produto->dimensoes_profundidade = '';
        // $produto->dimensoes_unidadeMedida = '';
        // $produto->sync = '';

        // Create a user
        $user = new User();
        $user->name = 'Tiago';
        $user->last_name = 'Silva';
        $user->email = 'tasilva@outlook.com';
        $user->password = bcrypt('abc123');
        $user->save();

        // Create a profile
        $blingToken = new \App\Models\BlingToken();
        $blingToken->client_id = 'f1f9eec7e739772c4a02d75f8dc78a2987c37b2f';
        $blingToken->client_secret = 'a2265ddbf52cf269fbb33348c82d6dce3b8a3fe8bcd14cf7b0d7487e6b15';
        $blingToken->access_token = '';
        $blingToken->token_type = '';
        $blingToken->refresh_token = '';
        $blingToken->sync = '';
        $user->bling_token()->save($blingToken); // save it using the hasOne
        // $user->produtos()->save($produto); // save it using the hasOne

        // $produto = new Produto();
        // $produto->bling_id = 'x';
        // $produto->idProdutoPai = 'x';
        // $produto->nome = 'Produto não cadastrado';
        // $produto->codigo = 'NAOCAD';
        // $produto->preco = '';
        // $produto->tipo = '';
        // $produto->situacao = '';
        // $produto->formato = '';
        // $produto->descricaoCurta = '';
        // $produto->imagemURL = '';
        // $produto->dataValidade = '';
        // $produto->unidade = '';
        // $produto->pesoLiquido = '';
        // $produto->pesoBruto = '';
        // $produto->volumes = '';
        // $produto->gtin = '';
        // $produto->gtinEmbalagem = '';
        // $produto->tipoProducao = '';
        // $produto->condicao = '';
        // $produto->freteGratis = '';
        // $produto->marca = '';
        // $produto->categoria_id = '';
        // $produto->estoque_minimo = '';
        // $produto->estoque_maximo = '';
        // $produto->estoque_crossdocking = '';
        // $produto->dimensoes_largura = '';
        // $produto->dimensoes_altura = '';
        // $produto->dimensoes_profundidade = '';
        // $produto->dimensoes_unidadeMedida = '';
        // $produto->sync = '';

        // Create a user
        $user = new User();
        $user->name = 'Tiago';
        $user->last_name = 'Silva';
        $user->email = 'tasiilva2@gmail.com';
        $user->password = bcrypt('abc123');
        $user->save();

        // Create a profile
        $blingToken = new \App\Models\BlingToken();
        $blingToken->client_id = '12b001262184998f743e741a0da93a5e7df850df';
        $blingToken->client_secret = '6e8e23814b5a6b2fb3fa9da3ec86aa5f63f9191fe9a315d1f2ad0a7742fe';
        $blingToken->access_token = '';
        $blingToken->token_type = '';
        $blingToken->refresh_token = '';
        $blingToken->sync = '';
        $user->bling_token()->save($blingToken); // save it using the hasOne
        // $user->produtos()->save($produto); // save it using the hasOne
    }
}
