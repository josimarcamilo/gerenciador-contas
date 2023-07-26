<?php

namespace Database\Factories;

use App\Models\FinancialArea;
use App\Models\FinancialPlanning;
use Faker\Core\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialPlanning>
 */
class FinancialPlanningFactory extends Factory
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
            'financial_area_id' => FinancialArea::factory()->create()->id,
            'reference_month' => now()->format('Y-m'),
            'status' => FinancialPlanning::OPEN,
        ];
    }
}
