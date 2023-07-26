<?php

namespace Tests\Feature;

use App\Models\Budget;
use App\Models\Extract;
use App\Models\FinancialPlanning;
use Tests\TestCase;

class CreateExtractTest extends TestCase
{
    /**
     * @return void
     */
    public function test_create_entry_successfull()
    {
        $financialPlanning = FinancialPlanning::factory()->create();

        $this->actingAs($financialPlanning->financialArea->admin);

        $response = $this->post('/api/extracts', [
            'financial_planning_code' => $financialPlanning->uuid,
            'type' => Extract::ENTRY,
            'description' => 'salário',
            'amount' => 500000,
        ]);

        $response->assertStatus(201);

        $json = $response->json();
    }

    /**
     * @return void
     */
    public function test_create_credit_card_successfull()
    {
        $financialPlanning = FinancialPlanning::factory()->create();

        $this->actingAs($financialPlanning->financialArea->admin);

        $response = $this->post('/api/extracts', [
            'financial_planning_code' => $financialPlanning->uuid,
            'type' => Extract::CREDIT_CARD,
            'description' => 'gasolina',
            'amount' => 10000,
        ]);

        $response->assertStatus(201);

        $json = $response->json();
    }

    /**
     * @return void
     */
    public function test_create_exit_successfull()
    {
        $financialPlanning = FinancialPlanning::factory()->create();

        $budgetTest = new Budget();
        $budgetTest->financial_planning_id = $financialPlanning->id;
        $budgetTest->description = 'category teste';
        $budgetTest->percentage = 50;
        $budgetTest->save();

        $this->actingAs($financialPlanning->financialArea->admin);

        $response = $this->post('/api/extracts', [
            'financial_planning_code' => $financialPlanning->uuid,
            'type' => Extract::EXIT,
            'description' => 'aluguel',
            'amount' => 70000,
            'category' => $budgetTest->id,
            'due_date' => now(),
            'status' => Extract::PENDING,
        ]);

        $response->assertStatus(201);

        $json = $response->json();
    }
}
