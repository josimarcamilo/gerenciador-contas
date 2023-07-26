<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_user_successfull()
    {
        $response = $this->post('/api/users', [
            'name' => uniqid('user_'),
            'email' => uniqid('email_') . '@test.com',
            'password' => uniqid(),
        ]);

        $response->assertStatus(200);

        $json = $response->json();

        $this->assertNotNull($json['name']);
        $this->assertNotNull($json['email']);
        $this->assertNotNull($json['created_at']);
        $this->assertNotNull($json['updated_at']);

        $this->assertCount(4, $json);

        $this->assertDatabaseHas('users', [
            'name' => $json['name'],
            'email' => $json['email'],
        ]);

        $this->assertDatabaseHas('financial_areas', [
            'description' => $json['name'],
        ]);
    }
}
