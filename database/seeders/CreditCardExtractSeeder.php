<?php

namespace Database\Seeders;

use App\Models\Extract;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CreditCardExtractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userDefault = User::where('email', 'admin@orfed.com.br')->first();
        $financialArea = $userDefault->financialAreas->first();
        $financialPlanning = $financialArea->financialPlannings->first();

        Extract::factory([
            'financial_planning_id'=>$financialPlanning->id,
            'type' => Extract::CREDIT_CARD,
        ])->state(new Sequence(
            fn ($sequence) => [
                'description' => fake()->name,
                'amount' => fake()->numberBetween(1000, 100000),
            ],
        ))->count(5)->create();
    }
}
