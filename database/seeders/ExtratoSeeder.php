<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Extrato;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExtratoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', User::EMAIL_PADRAO)->first();

        foreach(Budget::all() as $budget) {
            //receita
            for($i = 0; $i<5; $i++){
                $descricao = fake()->name();
                $valor = fake()->numberBetween(1000, 100000);
                Extrato::updateOrCreate([
                    'account_id' => $user->account->id,
                    'budget_id' => $budget->id,
                    'tipo' => Extrato::RECEITA,
                    'descricao' => $descricao,
                    'valor' => $valor
                ]);
            }
            //despesa
            $categories =  $budget->categories;
            for($i = 0; $i<20; $i++){
                $descricao = fake()->name();
                $valor = fake()->numberBetween(1000, 100000);
                Extrato::updateOrCreate([
                    'account_id' => $user->account->id,
                    'budget_id' => $budget->id,
                    'tipo' => Extrato::DESPESA,
                    'descricao' => $descricao,
                    'valor' => $valor,
                    'category_id' => $categories->random()->id,
                    'status' => fake()->randomElements([Extrato::PENDENTE, Extrato::PAGO])[0]
                ]);
            }

            //cartao
            for($i = 0; $i<20; $i++){
                $descricao = fake()->name();
                $valor = fake()->numberBetween(1000, 100000);
                Extrato::updateOrCreate([
                    'account_id' => $user->account->id,
                    'budget_id' => $budget->id,
                    'tipo' => Extrato::CARTAO,
                    'descricao' => $descricao,
                    'valor' => $valor,
                    'category_id' => $categories->random()->id,
                    'status' => Extrato::PENDENTE
                ]);
            }
        };
    }
}
