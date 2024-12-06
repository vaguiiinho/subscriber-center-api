<?php

namespace Tests\Unit\UseCase\Customer;

use Core\Domain\Entity\Customer;
use Core\Domain\Enum\PersonType;
use Core\Domain\Repository\CustomerRepositoryInterface;
use Core\Domain\ValueObject\{
    CnpjCpf,
    Uuid as ValueObjectUuid
};
use Core\UseCase\Customer\Create\CreateCustomerUseCase;
use Core\UseCase\Customer\Create\Dto\{
    CreateCustomerInputDto,
    CreateCustomerOutputDto
};
use DateTime;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateCustomerUseCaseTest extends TestCase
{
    public function testCreate()
    {
        // Arrange
        $uuid = (string) Uuid::uuid4();

        $mockRepository = Mockery::mock(stdClass::class, CustomerRepositoryInterface::class);

        $mockEntity = Mockery::mock(Customer::class, [
            true,
            PersonType::PHYSICAL,
            "client 1",
            new CnpjCpf('00011122233'),
            new DateTime('2023-12-15'),
            new DateTime('2023-12-20'),
            '10'

        ]);

        $mockEntity->shouldReceive('id')->andReturn(new ValueObjectUuid($uuid));
        $mockEntity->shouldReceive('birthDate')->andReturn(Date('Y-m-d'));
        $mockEntity->shouldReceive('registrationDate')->andReturn(Date('Y-m-d'));

        $mockRepository->shouldReceive('insert')
            ->once()
            ->andReturn($mockEntity);

        $mockInputDto = Mockery::mock(CreateCustomerInputDto::class, [
            true,
            'F',
            "client 1",
            '00011122233',
            '2023-12-15',
            '2023-12-20',
            '10'
        ]);

        $useCase = new CreateCustomerUseCase($mockRepository);

        // // Action
        $response =   $useCase->execute($mockInputDto);

        // // Assert
        $this->assertInstanceOf(CreateCustomerOutputDto::class, $response);
        $this->assertEquals($uuid, $response->id);
        
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
