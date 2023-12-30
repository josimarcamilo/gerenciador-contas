<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'se pagar',
            'doar',
            'poupar para os sonhos',
            'investir para ser rico',
            'pagar as contas',
            'abundar',
            'quitar as dívidas',
        ];

        $user = User::where('email', User::EMAIL_PADRAO)->first();

        foreach(Budget::all() as $budgets){
            foreach ($categories as $category) {
                Category::updateOrCreate([
                    'account_id' => $user->account->id,
                    'budget_id' => $budgets->id,
                    'description' => $category,
                ]);
            }
        };
    }
}
