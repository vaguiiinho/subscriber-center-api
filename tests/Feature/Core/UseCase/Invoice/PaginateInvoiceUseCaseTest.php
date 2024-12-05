<?php

namespace Tests\Feature\Core\UseCase\Invoice;

use App\Models\Invoice as Model;
use App\Repositories\Eloquent\InvoiceEloquentRepository;
use Core\UseCase\Invoice\Paginate\Dto\PaginateInvoiceInputDto;
use Core\UseCase\Invoice\Paginate\PaginateInvoiceUseCase;
use Tests\TestCase;

class PaginateInvoiceUseCaseTest extends TestCase
{
    public function test_list_empty()
    {
        $response = $this->createUseCase();
        $this->assertCount(0, $response->items);
    }

    public function test_list_all()
    {
        Model::factory()->count(20)->create();
        $response = $this->createUseCase();
        $this->assertCount(15, $response->items);
        $this->assertEquals(20, $response->total);
    }

    protected function createUseCase()
    {
        $repository = new InvoiceEloquentRepository(new Model());
        $useCase = new PaginateInvoiceUseCase($repository);
        return $useCase->execute(new PaginateInvoiceInputDto());
    }
}
