<?php

namespace Database\Seeders;

use App\Models\FinancialPlanning;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialPlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uuid = '0708efc7-3abc-3a08-9ae4-49f35bfc26fd';
        $userDefault = User::where('email', 'admin@orfed.com.br')->first();

        $financialArea = $userDefault->financialAreas->first();

        DB::table('financial_plannings')->updateOrInsert([
            'uuid' => $uuid,
            'financial_area_id' => $financialArea->id,
            'reference_month' => '2023-04',
            'status' => FinancialPlanning::OPEN,
        ]);
    }
}
