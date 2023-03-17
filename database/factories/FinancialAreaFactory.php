<?php

namespace Database\Factories;

use App\Models\User;
use Faker\Core\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialArea>
 */
class FinancialAreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => (new Uuid())->uuid3(),
            'description' => uniqid(),
            'user_id' => User::factory()->create()->id
        ];
    }
}
