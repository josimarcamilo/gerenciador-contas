<?php

namespace Database\Seeders;

use App\Models\Conta;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(
            [
                'email' => User::EMAIL_PADRAO,
            ],
            [
                'username' => 'admin',
                'firstname' => 'Admin',
                'lastname' => 'Admin',
                'password' => 'a',
            ]
        );

        Conta::updateOrCreate(['user_id' => $user->id]);
    }
}
