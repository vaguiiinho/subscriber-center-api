<?php

namespace Tests\Unit\UseCase\Customer;

use Core\Domain\Repository\CustomerRepositoryInterface;
use Core\UseCase\Customer\Paginate\{
    PaginateCustomerUseCase,
    Dto\PaginateCustomerInputDto,
    Dto\PaginateCustomerOutputDto,
};
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;
use Tests\Unit\UseCase\UseCaseTrait;

class PaginateCustomerUseCaseTest extends TestCase
{
    use UseCaseTrait;
    public function testPaginate()
    {
        // Arrange
        $mockRepository = Mockery::mock(stdClass::class, CustomerRepositoryInterface::class);
        $mockRepository->shouldReceive('paginate')
            ->once()
            ->andReturn($this->mockPagination());

        $useCase = new PaginateCustomerUseCase($mockRepository);

        $mockInput = Mockery::mock(PaginateCustomerInputDto::class, [
            'test',
            "desc",
            1,
            15
        ]);
        // Action

        $response = $useCase->execute($mockInput);

        // Assert
        $this->assertInstanceOf(PaginateCustomerOutputDto::class, $response);

        Mockery::close();
    }
}