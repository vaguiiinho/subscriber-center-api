<?php

namespace Core\UseCase\Contract\Paginate;

use Core\Domain\Repository\ContractRepositoryInterface;
use Core\UseCase\Contract\Paginate\Dto\{
    PaginateContractInputDto,
    PaginateContractOutputDto,
};

class PaginateContractUseCase
{
    public function __construct(protected ContractRepositoryInterface $repository) {}

    public function execute(PaginateContractInputDto $inputDto): PaginateContractOutputDto
    {
        $response = $this->repository->paginate(
            filter: $inputDto->filter,
            order: $inputDto->order,
            page: $inputDto->page,
            totalPage: $inputDto->totalPage,
        );

        return new PaginateContractOutputDto(
            items: $response->items(),
            total: $response->total(),
            current_page: $response->currentPage(),
            first_page: $response->firstPage(),
            last_page: $response->lastPage(),
            per_page: $response->perPage(),
            to: $response->to(),
            from: $response->from()
        );
    }
}