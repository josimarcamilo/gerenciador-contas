<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Orcamento;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            'se pagar',
            'doar',
            'poupar para os sonhos',
            'investir para ser rico',
            'pagar as contas',
            'abundar',
            'quitar as dívidas',
        ];

        $user = User::where('email', User::EMAIL_PADRAO)->first();

        foreach(Orcamento::all() as $orcamento){
            foreach ($categorias as $categoria) {
                Categoria::updateOrCreate([
                    'conta_id' => $user->conta->id,
                    'orcamento_id' => $orcamento->id,
                    'descricao' => $categoria,
                ]);
            }
        };
    }
}
