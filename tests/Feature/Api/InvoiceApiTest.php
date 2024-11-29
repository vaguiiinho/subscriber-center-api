<?php

namespace Tests\Feature\Api;

use App\Models\Invoice;
use Illuminate\Http\Response;
use Tests\TestCase;

class InvoiceApiTest extends TestCase
{
    private $endPoint = '/api/invoices';

    public function test_get_all_empty()
    {
        $response = $this->getJson($this->endPoint);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(0, 'data');
    }

    public function test_get_pagination()
    {
        Invoice::factory()->count(30)->create();

        $response = $this->getJson($this->endPoint);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(15, 'data');
        $response->assertJsonStructure([
            'meta' => [
                'total',
                'current_page',
                'last_page',
                'first_page',
                'per_page',
                'to',
                'from'
            ],
        ]);
    }

    public function test_get_pagination_two()
    {
        Invoice::factory()->count(20)->create();

        $response = $this->getJson("$this->endPoint/?page=2");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(5, 'data');
        $this->assertEquals(20, $response['meta']['total']);
        $this->assertEquals(2, $response['meta']['current_page']);
    }

    public function test_pagination_with_filter()
    {
        Invoice::factory()->count(20)->create(['status' => 'A']);
        Invoice::factory()->count(5)->create(['status' => 'R']);

        $response = $this->getJson("$this->endPoint/?filter=R");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(5, 'data');
    }
}
