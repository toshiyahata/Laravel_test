<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCampaignTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->post('/api/campaigns', [
            "campaign_name1" => "なんとかかんとかキャンペーン",
            "campaign_name2" => "test",
            "order_date" => "2024-01-01",
            "deadline" => "2024-05-01",
            "supplier_order_number" => "",
            "client_code" => "00000-000",
            "department_name" => "ファミリーマートグループ事業部",
            "email_sales" => "yahata.toshiya@mic-p.com",
            "email_manager" => "yahata.toshiya@mic-p.com",
            "order_category" => "印刷／調達",
            "order_numbers" => [
                "B24000012",
                "B25000123"
            ]       
        ]);

        $response->assertStatus(200);
    }
}
