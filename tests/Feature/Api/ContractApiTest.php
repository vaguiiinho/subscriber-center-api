<?php

namespace Tests\Feature\Api;

use App\Models\Contract;
use Illuminate\Http\Response;
use Tests\TestCase;

class ContractApiTest extends TestCase
{
    private $endPoint = '/api/contracts';

    public function test_get_all_empty()
    {
        $response = $this->getJson($this->endPoint);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(0, 'data');
    }

    public function test_get_pagination()
    {
        Contract::factory()->count(30)->create();

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
        Contract::factory()->count(20)->create();

        $response = $this->getJson("$this->endPoint/?page=2");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(5, 'data');
        $this->assertEquals(20, $response['meta']['total']);
        $this->assertEquals(2, $response['meta']['current_page']);
    }

    public function test_pagination_with_filter()
    {
        Contract::factory()->count(20)->create(['contractStatus' => 'I']);
        Contract::factory()->count(5)->create(['contractStatus' => 'A']);

        $response = $this->getJson("$this->endPoint/?filter=A");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(5, 'data');
    }
}
