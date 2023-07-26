<?php

namespace Tests\Feature;

use App\Models\FinancialPlanning;
use Tests\TestCase;

class CreateBudgetTest extends TestCase
{
    /**
     * @return void
     */
    public function test_create_budget_successfull()
    {
        $financialPlanning = FinancialPlanning::factory()->create();

        $this->actingAs($financialPlanning->financialArea->admin);

        $response = $this->post('/api/budgets', [
            'financial_planning_code' => $financialPlanning->uuid,
            'categories' => [
                [
                    'description' => 'me pagar',
                    'percentage' => 10,
                ],
                [
                    'description' => 'doar',
                    'percentage' => 10,
                ],
                [
                    'description' => 'pagar as contas',
                    'percentage' => 50,
                ],
                [
                    'description' => 'investir para ser rico',
                    'percentage' => 10,
                ],
                [
                    'description' => 'poupar para os sonhos',
                    'percentage' => 10,
                ],
                [
                    'description' => 'abundar',
                    'percentage' => 10,
                ],
                [
                    'description' => 'pagar dívidas',
                    'percentage' => 0,
                ],
            ],
        ]);

        $response->assertStatus(201);

        $json = $response->json();

        $this->assertIsArray($json);

        foreach ($json as $item) {
            $this->assertCount(5, $item);

            $this->assertNotNull($item['id']);
            $this->assertNotNull($item['description']);
            $this->assertNotNull($item['percentage']);
            $this->assertNotNull($item['created_at']);
            $this->assertNotNull($item['updated_at']);
        }
    }
}
