<?php

namespace Core\UseCase\Invoice\Create;

use Core\Domain\Entity\Contract;
use Core\Domain\Entity\Invoice;
use Core\Domain\Enum\ContractStatus;
use Core\Domain\Enum\InternetStatus;
use Core\Domain\Enum\InvoiceReceiptType;
use Core\Domain\Enum\InvoiceStatus;
use Core\Domain\Repository\ContractRepositoryInterface;
use Core\Domain\Repository\InvoiceRepositoryInterface;
use Core\UseCase\Contract\Create\Dto\CreateContractInputDto;
use Core\UseCase\Contract\Create\Dto\CreateContractOutputDto;
use Core\UseCase\Invoice\Create\Dto\CreateInvoiceInputDto;
use Core\UseCase\Invoice\Create\Dto\CreateInvoiceOutputDto;
use DateTime;

class CreateContractUseCase
{

    public function __construct(protected ContractRepositoryInterface $invoiceRepository) {}

    public function execute(CreateContractInputDto $inputDto): CreateContractOutputDto
    {
        $invoice = new Contract(
            activationDate: new DateTime($inputDto->activationDate),
            renewalDate: new DateTime($inputDto->renewalDate),
            contractStatus: ContractStatus::from($inputDto->contractStatus),
            internetStatus: InternetStatus::from($inputDto->internetStatus),
            idExternal: $inputDto->idExternal
        );
        $response = $this->invoiceRepository->insert($invoice);
       
        // Return output DTO
        return new CreateContractOutputDto(
            id: $response->id(),
            activationDate: $response->activationDate(),
            renewalDate: $response->renewalDate(),
            contractStatus: $response->contractStatus->value,
            internetStatus: $response->internetStatus->value,
            idExternal: $response->idExternal
            street: $response->,
            number: '',
            neighborhood: '',
            complement: '',
            city: '',
        );
    }
}
