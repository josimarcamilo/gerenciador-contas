<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // bcrypt('secret')
        DB::table('users')->updateOrInsert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@orfed.com.br',
            'password' => '$2y$10$RiUxrJkNYS9x0WZ61FQYCOw.3qo.4TWCSSIsZqyfz4XuMuIB14Bta'
        ]);
    }
}
