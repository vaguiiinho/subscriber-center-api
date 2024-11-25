<?php

namespace Core\UseCase\Invoice\Create;

use Core\Domain\Entity\Invoice;
use Core\Domain\Enum\InvoiceReceiptType;
use Core\Domain\Enum\InvoiceStatus;
use Core\Domain\Repository\InvoiceRepositoryInterface;
use Core\UseCase\Invoice\Create\Dto\CreateInvoiceInputDto;
use Core\UseCase\Invoice\Create\Dto\CreateInvoiceOutputDto;
use DateTime;

class CreateInvoiceUseCase
{

    public function __construct(protected InvoiceRepositoryInterface $invoiceRepository) {}

    public function execute(CreateInvoiceInputDto $inputDto): CreateInvoiceOutputDto
    {
        $invoice = new Invoice(
            new DateTime($inputDto->emissonDate),
            new DateTime($inputDto->maturityDate),
            $inputDto->amount,
            InvoiceReceiptType::from($inputDto->receiptType),
            InvoiceStatus::from($inputDto->status),
            $inputDto->idExternal
        );
        $response = $this->invoiceRepository->insert($invoice);

        // Return output DTO
        return new CreateInvoiceOutputDto(
            $response->id(),
            $response->emissonDate()->format('Y-m-d'),
            $response->maturityDate()->format('Y-m-d'),
            $response->amount,
            $response->receiptType->vlaue,
            $response->status->vlaue,
            $response->idExternal
        );
    }
}
