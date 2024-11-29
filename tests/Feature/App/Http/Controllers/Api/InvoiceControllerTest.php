<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Http\Controllers\Api\InvoiceController;
use App\Models\Invoice as Model;
use App\Repositories\Eloquent\InvoiceEloquentRepository;
use Core\UseCase\Invoice\Paginate\PaginateInvoiceUseCase;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InvoiceControllerTest extends TestCase
{
    protected $repository;
    protected $controller;
    protected function setUp(): void
    {
        $this->repository = new InvoiceEloquentRepository(new Model);
        $this->controller = new InvoiceController();
        parent::setUp();
    }

    public function test_index()
    {

        $useCase = new PaginateInvoiceUseCase($this->repository);

        $response = $this->controller->index(new Request, $useCase);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $response);
        $this->assertArrayHasKey('meta', $response->additional);
    }
}
