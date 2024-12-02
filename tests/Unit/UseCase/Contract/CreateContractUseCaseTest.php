<?php

namespace Tests\Unit\UseCase\Contract;

use Core\Domain\Entity\Contract;
use Core\Domain\Enum\{
    ContractStatus,
    InternetStatus
};
use Core\Domain\Repository\ContractRepositoryInterface;
use Core\Domain\ValueObject\Uuid as ValueObjectUuid;
use DateTime;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateInvoiceUseCaseTest extends TestCase
{
    public function testCreate()
    {
        // Arrange
        $uuid = (string) Uuid::uuid4();

        $mockRepository = Mockery::mock(stdClass::class, ContractRepositoryInterface::class);

        $mockEntity = Mockery::mock(Contract::class, [
            'activationDate' => new DateTime('2023-12-15'),
            'renewalDate' => new DateTime('2024-01-01'),
            'contractStatus' => ContractStatus::ACTIVE,
            'internetStatus' => InternetStatus::ACTIVE,
            'idExternal' => '10'
        ]);

        $mockEntity->shouldReceive('id')->andReturn(new ValueObjectUuid($uuid));
        $mockEntity->shouldReceive('activationDate')->andReturn(Date('Y-m-d'));
        $mockEntity->shouldReceive('renewalDate')->andReturn(Date('Y-m-d'));

        $mockRepository->shouldReceive('insert')
            ->once()
            ->andReturn($mockEntity);

        $mockInputDto = Mockery::mock(CreateContractInputDto::class, [
            'activationDate' => '2023-12-15',
            'renewalDate' => '2023-12-20',
            'contractStatus' => 'A',
            'internetStatus' => 'A',
            'idExternal' => '10'
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

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
