<?php

namespace Tests\Unit\UseCase\Contract;

use Core\Domain\Repository\ContractRepositoryInterface;
use Core\UseCase\Contract\Paginate\{
    PaginateContractUseCase,
    Dto\PaginateContractInputDto,
    Dto\PaginateContractOutputDto,
};
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;
use Tests\Unit\UseCase\UseCaseTrait;

class PaginateContractUseCaseTest extends TestCase
{
    use UseCaseTrait;
    public function testPaginate()
    {
        // Arrange
        $mockRepository = Mockery::mock(stdClass::class, ContractRepositoryInterface::class);
        $mockRepository->shouldReceive('paginate')
            ->once()
            ->andReturn($this->mockPagination());

        $useCase = new PaginateContractUseCase($mockRepository);

        $mockInput = Mockery::mock(PaginateContractInputDto::class, [
            'test',
            "desc",
            1,
            15
        ]);
        // Action

        $response = $useCase->execute($mockInput);

        // Assert
        $this->assertInstanceOf(PaginateContractOutputDto::class, $response);

        Mockery::close();
    }
}