<?php

namespace Core\UseCase\Invoice\Paginate;

use Core\Domain\Repository\InvoiceRepositoryInterface;
use Core\UseCase\Invoice\Paginate\Dto\{
    PaginateInvoiceInputDto,
    PaginateInvoiceOutputDto,
};

class PaginateInvoiceUseCase
{
    public function __construct(protected InvoiceRepositoryInterface $repository) {}

    public function execute(PaginateInvoiceInputDto $inputDto): PaginateInvoiceOutputDto
    {
        $response = $this->repository->paginate(
            filter: $inputDto->filter,
            order: $inputDto->order,
            page: $inputDto->page,
            totalPage: $inputDto->totalPage,
        );

        return new PaginateInvoiceOutputDto(
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