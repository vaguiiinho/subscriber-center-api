<?php

namespace Tests\Feature\App\Repositories\Eloquent;

use App\Models\Contract as Model;
use App\Repositories\Eloquent\ContractEloquentRepository;
use Core\Domain\Entity\Contract as Entity;
use Core\Domain\Enum\ContractStatus;
use Core\Domain\Enum\InternetStatus;
use Core\Domain\Repository\ContractRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Domain\ValueObject\Address;
use DateTime;
use Tests\TestCase;

class ContractEloquentRepositoryTest extends TestCase
{
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new ContractEloquentRepository(new Model());
        $this->assertInstanceOf(ContractRepositoryInterface::class, $this->repository);
    }

    public function testInsert()
    {

        $entity = new Entity(
            activationDate: new DateTime('2023-12-15'),
            renewalDate: new DateTime('2023-12-20'),
            contractStatus: ContractStatus::ACTIVE,
            internetStatus: InternetStatus::ACTIVE,
            idExternal: '10',
        );

        $response = $this->repository->insert($entity);

        $this->assertInstanceOf(Entity::class, $response);
        $this->assertDatabaseHas('contracts', [
            'activationDate' => '2023-12-15 00:00:00',
            'renewalDate' => '2023-12-20 00:00:00',
            'contractStatus' => 'A',
            'internetStatus' => 'A',
        ]);
    }

    public function testInsertWithRelationship()
    {
        Model::factory()->count(4)->create();

        $entity = new Entity(
            activationDate: new DateTime('2023-12-15'),
            renewalDate: new DateTime('2023-12-20'),
            contractStatus: ContractStatus::ACTIVE,
            internetStatus: InternetStatus::ACTIVE,
            idExternal: '10',
        ); 

        $entity->setAddress(new Address(
            street: '123 Main St',
            number: '456',
            neighborhood: 'Downtown',
            complement: 'Apt 789',
            city: 'Springfield',
        ));

        $response = $this->repository->insert($entity);

        $this->assertNotEmpty($response->id);
        $this->assertDatabaseHas('addresses', [
            'street' => '123 Main St',
            'number' => '456',
            'neighborhood' => 'Downtown',
            'complement' => 'Apt 789',
            'city' => 'Springfield',
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
