<?php

namespace Core\UseCase\Customer\Paginate;

use Core\Domain\Repository\CustomerRepositoryInterface;
use Core\UseCase\Customer\Paginate\Dto\{
    PaginateCustomerInputDto,
    PaginateCustomerOutputDto,
};

class PaginateCustomerUseCase
{
    public function __construct(protected CustomerRepositoryInterface $repository) {}

    public function execute(PaginateCustomerInputDto $inputDto): PaginateCustomerOutputDto
    {
        $response = $this->repository->paginate(
            filter: $inputDto->filter,
            order: $inputDto->order,
            page: $inputDto->page,
            totalPage: $inputDto->totalPage,
        );

        return new PaginateCustomerOutputDto(
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