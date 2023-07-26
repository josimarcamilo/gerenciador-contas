<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uuid = '0a5d766e-e03a-3b40-8052-d5d283ad283d';
        $userDefault = User::where('email', 'admin@orfed.com.br')->first();

        DB::table('financial_areas')->updateOrInsert([
            'uuid' => $uuid,
            'user_id' => $userDefault->id,
            'description' => $userDefault->email,
        ]);
    }
}
