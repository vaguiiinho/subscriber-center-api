<?php

namespace Tests\Feature\App\Repositories\Eloquent;

use App\Models\Invoice as Model;
use App\Repositories\Eloquent\InvoiceEloquentRepository;
use Core\Domain\Entity\Invoice as Entity;
use Core\Domain\Enum\InvoiceReceiptType;
use Core\Domain\Enum\InvoiceStatus;
use Core\Domain\Repository\InvoiceRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use DateTime;
use Tests\TestCase;

class InvoiceEloquentRepositoryTest extends TestCase
{
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new InvoiceEloquentRepository(new Model());
        $this->assertInstanceOf(InvoiceRepositoryInterface::class, $this->repository);
    }

    public function testInsert()
    {

        $entity = new Entity(
            emissionDate: new DateTime('2023-12-15'),
            maturityDate: new Datetime('2023-12-20'),
            amount: 100,
            receiptType: InvoiceReceiptType::PIX,
            status: InvoiceStatus::RECEIVED,
            idExternal: '10'
        );

        $response = $this->repository->insert($entity);

        $this->assertInstanceOf(Entity::class, $response);
        $this->assertDatabaseHas('invoices', [
            'emissionDate' => '2023-12-15 00:00:00',
            'maturityDate' => '2023-12-20 00:00:00',
            'amount' => 100,
            'receiptType' => 'P',
            'status' => 'R',
        ]);
    }

    public function testPaginate()
    {
        Model::factory()->count(20)->create();

        $response = $this->repository->paginate();

        $this->assertInstanceOf(PaginationInterface::class, $response);
        $this->assertCount(15, $response->items());
    }

    public function testPaginateWithout()
    {
        $response = $this->repository->paginate();

        $this->assertInstanceOf(PaginationInterface::class, $response);
        $this->assertCount(0, $response->items());
    }
}
