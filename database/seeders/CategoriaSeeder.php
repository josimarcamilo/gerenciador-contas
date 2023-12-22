<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Categoria;
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

        foreach(Budget::all() as $orcamento){
            foreach ($categorias as $categoria) {
                Categoria::updateOrCreate([
                    'account_id' => $user->account->id,
                    'budget_id' => $orcamento->id,
                    'descricao' => $categoria,
                ]);
            }
        };
    }
}
