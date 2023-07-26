<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class CreateTokenUserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_token_user_successfull()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/users/tokens', [
            'email' => $user->email,
            'password' => 'password',
            'token_name' => 'token',
        ]);

        $json = $response->json();
        $response->assertStatus(200);
        $this->assertNotNull($json['token']);
    }
}
