<?php

namespace Tests\Unit\UseCase\Contract;

use Core\Domain\Entity\Contract;
use Core\Domain\Enum\{
    ContractStatus,
    InternetStatus
};
use Core\Domain\Repository\ContractRepositoryInterface;
use Core\Domain\ValueObject\Address;
use Core\Domain\ValueObject\Uuid as ValueObjectUuid;
use Core\UseCase\Contract\Create\Dto\{
    CreateContractInputDto,
    CreateContractOutputDto
};
use Core\UseCase\Contract\Create\CreateContractUseCase;
use DateTime;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateContractUseCaseTest extends TestCase
{
    public function testCreate()
    {
        // Arrange
        $uuid = (string) Uuid::uuid4();

        $mockRepository = Mockery::mock(stdClass::class, ContractRepositoryInterface::class);

        $mockEntity = Mockery::mock(Contract::class, [
            new DateTime('2023-12-15'),
            new DateTime('2024-01-01'),
            ContractStatus::ACTIVE,
            InternetStatus::ACTIVE,
            '10',

        ]);

        $mockEntity->shouldReceive('id')->andReturn(new ValueObjectUuid($uuid));
        $mockEntity->shouldReceive('activationDate')->andReturn(Date('Y-m-d'));
        $mockEntity->shouldReceive('renewalDate')->andReturn(Date('Y-m-d'));

        $mockRepository->shouldReceive('insert')
            ->once()
            ->andReturn($mockEntity);

        $mockInputDto = Mockery::mock(CreateContractInputDto::class, [
            '2023-12-15',
            '2023-12-20',
            'A',
            'A',
            '10'
        ]);

        $useCase = new CreateContractUseCase($mockRepository);

        // // Action
        $response =   $useCase->execute($mockInputDto);

        // // Assert
        $this->assertInstanceOf(CreateContractOutputDto::class, $response);
        $this->assertEquals($uuid, $response->id);
        $this->assertEquals('2023-12-15', $response->activationDate);
        $this->assertEquals('2023-12-20', $response->renewalDate);
        $this->assertEquals('A', $response->contractStatus);
        $this->assertEquals('A', $response->internetStatus);
        $this->assertEquals('10', $response->idExternal);
    }

    public function testCreateWithAddress()
    {
        // Arrange
        $uuid = (string) Uuid::uuid4();

        $mockRepository = Mockery::mock(stdClass::class, ContractRepositoryInterface::class);

        $mockEntity = Mockery::mock(Contract::class, [
            new DateTime('2023-12-15'),
            new DateTime('2024-01-01'),
            ContractStatus::ACTIVE,
            InternetStatus::ACTIVE,
            '10',
            new Address(
                street: 'Rua Teste',
                number: '123',
                neighborhood: 'Bairro Teste',
                complement: 'Apt 123',
                city: 'Cidade Teste',
            )
        ]);

        $mockEntity->shouldReceive('id')->andReturn(new ValueObjectUuid($uuid));
        $mockEntity->shouldReceive('activationDate')->andReturn(Date('Y-m-d'));
        $mockEntity->shouldReceive('renewalDate')->andReturn(Date('Y-m-d'));

        $mockRepository->shouldReceive('insert')
            ->once()
            ->andReturn($mockEntity);

        $mockInputDto = Mockery::mock(CreateContractInputDto::class, [
            '2023-12-15',
            '2023-12-20',
            'A',
            'A',
            '10',
            new Address(
                street: 'Rua Teste',
                number: '123',
                neighborhood: 'Bairro Teste',
                complement: 'Apt 123',
                city: 'Cidade Teste',

            )
        ]);
        $useCase = new CreateContractUseCase($mockRepository);
        // Action
        $response = $useCase->execute($mockInputDto);
        // Assert
        $this->assertEquals($uuid, $response->id);
        $this->assertEquals('Rua Teste', $response->street);
        $this->assertEquals('123', $response->number);
        $this->assertEquals('Bairro Teste', $response->neighborhood);
        $this->assertEquals('Apt 123', $response->complement);
        $this->assertEquals('Cidade Teste', $response->city);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
