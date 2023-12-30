<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Extract;
use App\Models\Extrato;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExtractSeeder extends Seeder
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
                $description = fake()->name();
                $value = fake()->numberBetween(1000, 100000);
                Extract::updateOrCreate([
                    'account_id' => $user->account->id,
                    'budget_id' => $budget->id,
                    'type' => Extract::RECEITA,
                    'description' => $description,
                    'value' => $value
                ]);
            }
            //despesa
            $categories =  $budget->categories;
            for($i = 0; $i<20; $i++){
                $description = fake()->name();
                $value = fake()->numberBetween(1000, 100000);
                Extract::updateOrCreate([
                    'account_id' => $user->account->id,
                    'budget_id' => $budget->id,
                    'type' => Extract::DESPESA,
                    'description' => $description,
                    'value' => $value,
                    'category_id' => $categories->random()->id,
                    'status' => fake()->randomElements([Extract::PENDENTE, Extract::PAGO])[0]
                ]);
            }

            //cartao
            for($i = 0; $i<20; $i++){
                $description = fake()->name();
                $value = fake()->numberBetween(1000, 100000);
                Extract::updateOrCreate([
                    'account_id' => $user->account->id,
                    'budget_id' => $budget->id,
                    'type' => Extract::CARTAO,
                    'description' => $description,
                    'value' => $value,
                    'category_id' => $categories->random()->id,
                    'status' => Extract::PENDENTE
                ]);
            }
        };
    }
}
