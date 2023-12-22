<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrcamentoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', User::EMAIL_PADRAO)->first();

        for($count = 0; $count < 3; $count++){
            Budget::updateOrCreate([
                'account_id' => $user->account->id,
                'month' => now()->addMonth($count)->format('Y-m-d'),
            ]);
        }
    }
}
