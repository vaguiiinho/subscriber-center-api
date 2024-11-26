<?php

namespace Tests\Unit\UseCase\Invoice;

use Core\Domain\Entity\Invoice;
use Core\Domain\Enum\InvoiceReceiptType;
use Core\Domain\Enum\InvoiceStatus;
use Core\Domain\Repository\InvoiceRepositoryInterface;
use Core\Domain\ValueObject\Uuid as ValueObjectUuid;
use Core\UseCase\Invoice\Create\{
    CreateInvoiceUseCase,
    Dto\CreateInvoiceInputDto,
    Dto\CreateInvoiceOutputDto,
};
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

        $mockRepository = Mockery::mock(stdClass::class, InvoiceRepositoryInterface::class);

        $mockEntity = Mockery::mock(Invoice::class, [
            new DateTime('2023-12-15'),
            new Datetime('2023-12-20'),
            100,
            InvoiceReceiptType::PIX,
            InvoiceStatus::RECEIVED,
            '10'
        ]);

        $mockEntity->shouldReceive('id')->andReturn(new ValueObjectUuid($uuid));
        $mockEntity->shouldReceive('emissonDate')->andReturn(Date('Y-m-d'));
        $mockEntity->shouldReceive('maturityDate')->andReturn(Date('Y-m-d'));

        $mockRepository->shouldReceive('insert')
            // ->once()
            ->andReturn($mockEntity);

        $mockInputDto = Mockery::mock(CreateInvoiceInputDto::class, [
            '2023-12-15',
            '2023-12-20',
            100,
            'P',
            'R',
            '10'
        ]);

        $useCase = new CreateInvoiceUseCase($mockRepository);

        // // Action
        $response =   $useCase->execute($mockInputDto);

        // // Assert
        $this->assertInstanceOf(CreateInvoiceOutputDto::class, $response);
        $this->assertEquals($uuid, $response->id);
        $this->assertEquals('2023-12-15', $response->emissonDate);
        $this->assertEquals('2023-12-20', $response->maturityDate);
        $this->assertEquals(100, $response->amount);
        $this->assertEquals('P', $response->receiptType);
        $this->assertEquals('R', $response->status);
        $this->assertEquals('10', $response->idExternal);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
