<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetSeeder extends Seeder
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

        DB::table('budgets')->updateOrInsert([
            'financial_planning_id' => $financialPlanning->id,
            'description' => 'se pagar primeiro',
            'percentage' => 10,
        ]);
        DB::table('budgets')->updateOrInsert([
            'financial_planning_id' => $financialPlanning->id,
            'description' => 'doação',
            'percentage' => 10,
        ]);
        DB::table('budgets')->updateOrInsert([
            'financial_planning_id' => $financialPlanning->id,
            'description' => 'poupar para os sonhos',
            'percentage' => 10,
        ]);
        DB::table('budgets')->updateOrInsert([
            'financial_planning_id' => $financialPlanning->id,
            'description' => 'investir para ser rico',
            'percentage' => 10,
        ]);
        DB::table('budgets')->updateOrInsert([
            'financial_planning_id' => $financialPlanning->id,
            'description' => 'pagar as contas',
            'percentage' => 50,
        ]);

        DB::table('budgets')->updateOrInsert([
            'financial_planning_id' => $financialPlanning->id,
            'description' => 'abundar',
            'percentage' => 5,
        ]);
        DB::table('budgets')->updateOrInsert([
            'financial_planning_id' => $financialPlanning->id,
            'description' => 'pagar as dívidas',
            'percentage' => 5,
        ]);
    }
}
