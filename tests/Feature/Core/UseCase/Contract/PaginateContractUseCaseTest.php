<?php

namespace Tests\Feature\Core\UseCase\Contract;

use App\Models\Contract as Model;
use App\Repositories\Eloquent\ContractEloquentRepository;
use Core\UseCase\Contract\Paginate\Dto\PaginateContractInputDto;
use Core\UseCase\Contract\Paginate\PaginateContractUseCase;
use Tests\TestCase;

class PaginateContractUseCaseTest extends TestCase
{
    public function test_list_empty()
    {
        $response = $this->createUseCase();
        $this->assertCount(0, $response->items);
    }

    public function test_list_all()
    {
        Model::factory()->count(20)->create();
        $response = $this->createUseCase();
        $this->assertCount(15, $response->items);
        $this->assertEquals(20, $response->total);
    }

    protected function createUseCase()
    {
        $repository = new ContractEloquentRepository(new Model());
        $useCase = new PaginateContractUseCase($repository);
        return $useCase->execute(new PaginateContractInputDto());
    }
}
