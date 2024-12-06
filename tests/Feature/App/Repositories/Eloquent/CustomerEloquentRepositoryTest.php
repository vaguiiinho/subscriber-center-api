<?php

namespace Tests\Feature\App\Repositories\Eloquent;

use App\Models\Customer as Model;
use App\Repositories\Eloquent\CustomerEloquentRepository;
use Core\Domain\Entity\Customer as Entity;
use Core\Domain\Enum\PersonType;
use Core\Domain\Repository\{
    CustomerRepositoryInterface,
    PaginationInterface
};
use Core\Domain\ValueObject\CnpjCpf;
use DateTime;
use Tests\TestCase;

class CustomerEloquentRepositoryTest extends TestCase
{
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new CustomerEloquentRepository(new Model());
        $this->assertInstanceOf(CustomerRepositoryInterface::class, $this->repository);
    }

    public function testInsert()
    {

        $entity = new Entity(
            active: true,
            personType: PersonType::PHYSICAL,
            name: 'John Doe',
            cnpj_cpf: new CnpjCpf('12345678901234'),
            birthDate: new DateTime('1990-01-01'),
            registrationDate: new DateTime('2023-12-01'),
            idExternal: '10'
        );

        $response = $this->repository->insert($entity);

        $this->assertInstanceOf(Entity::class, $response);
        
        $this->assertDatabaseHas('customers', [
            'id' => $response->id(),
            'active' => true,
            'personType' => 'F',
            'name' => 'John Doe',
            'cnpj_cpf' => '12345678901234',
            'birthDate' => '1990-01-01 00:00:00',
            'registrationDate' => '2023-12-01 00:00:00',
            'idExternal' => '10',
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
