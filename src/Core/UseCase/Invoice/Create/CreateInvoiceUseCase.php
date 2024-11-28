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
            emissionDate: new DateTime($inputDto->emissionDate),
            maturityDate: new DateTime($inputDto->maturityDate),
            amount: $inputDto->amount,
            receiptType: InvoiceReceiptType::from($inputDto->receiptType),
            status: InvoiceStatus::from($inputDto->status),
            idExternal: $inputDto->idExternal
        );
        $response = $this->invoiceRepository->insert($invoice);
       
        // Return output DTO
        return new CreateInvoiceOutputDto(
            id: $response->id(),
            emissionDate: $invoice->emissionDate(),
            maturityDate: $invoice->maturityDate(),
            amount: $invoice->amount,
            receiptType: $response->receiptType->value,
            status: $response->status->value,
            idExternal: $response->idExternal
        );
    }
}
