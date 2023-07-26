<?php

namespace Tests\Feature;

use App\Models\FinancialArea;
use Tests\TestCase;

class CreateFinancialPlanningTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_financial_planning_successfull()
    {
        $financialArea = FinancialArea::factory()->create();

        $this->actingAs($financialArea->admin, 'web');

        $response = $this->post('/api/plannings', [
            'financial_area_code' => $financialArea->uuid,
            'reference_month' => now()->format('Y-m'),
        ]);

        $json = $response->json();
        $response->assertStatus(201);

        $this->assertNotNull($json['id']);
        $this->assertNotNull($json['status']);
        $this->assertNotNull($json['reference_month']);
        $this->assertNotNull($json['created_at']);
        $this->assertNotNull($json['updated_at']);

        $this->assertCount(5, $json);

        // $this->assertDatabaseHas('financial_plannings', [
        //     'financial_area_id' => $json['name'],
        //     'reference_month' => $json['email']
        // ]);

        // $this->assertDatabaseHas('financial_areas', [
        //     'description' => $json['name']
        // ]);
    }
}
