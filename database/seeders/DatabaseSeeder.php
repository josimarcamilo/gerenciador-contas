<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            FinancialAreaSeeder::class,
            FinancialPlanningSeeder::class,
            BudgetSeeder::class,
            EntryExtractSeeder::class,
            ExitExtractSeeder::class,
            CreditCardExtractSeeder::class,
        ]);
    }
}
