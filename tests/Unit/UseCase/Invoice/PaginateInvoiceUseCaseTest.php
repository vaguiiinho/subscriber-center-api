<?php

namespace Tests\Unit\UseCase\Invoice;

use Core\Domain\Repository\InvoiceRepositoryInterface;
use Core\UseCase\Invoice\Paginate\{
    PaginateInvoiceUseCase,
    Dto\PaginateInvoiceInputDto,
    Dto\PaginateInvoiceOutputDto,
};
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;
use Tests\Unit\UseCase\UseCaseTrait;

class PaginateInvoiceUseCaseTest extends TestCase
{
    use UseCaseTrait;
    public function testPaginate()
    {
        // Arrange
        $mockRepository = Mockery::mock(stdClass::class, InvoiceRepositoryInterface::class);
        $mockRepository->shouldReceive('paginate')
            ->once()
            ->andReturn($this->mockPagination());

        $useCase = new PaginateInvoiceUseCase($mockRepository);

        $mockInput = Mockery::mock(PaginateInvoiceInputDto::class, [
            'test',
            "desc",
            1,
            15
        ]);
        // Action

        $response = $useCase->execute($mockInput);
dump($response);
        // Assert
        $this->assertInstanceOf(PaginateInvoiceOutputDto::class, $response);

        Mockery::close();
    }
}