<?php

namespace Core\UseCase\Contract\Create;

use Core\Domain\Entity\Contract;
use Core\Domain\Enum\{
    ContractStatus,
    InternetStatus
};
use Core\Domain\Repository\ContractRepositoryInterface;
use Core\Domain\ValueObject\Address;
use Core\UseCase\Contract\Create\Dto\{
    CreateContractInputDto,
    CreateContractOutputDto
};
use DateTime;

class CreateContractUseCase
{

    public function __construct(protected ContractRepositoryInterface $repository) {}

    public function execute(CreateContractInputDto $inputDto): CreateContractOutputDto
    {
        $contract = new Contract(
            activationDate: new DateTime($inputDto->activationDate),
            renewalDate: new DateTime($inputDto->renewalDate),
            contractStatus: ContractStatus::from($inputDto->contractStatus),
            internetStatus: InternetStatus::from($inputDto->internetStatus),
            idExternal: $inputDto->idExternal,
        );

        if ($inputDto->address) {
            $contract->setAddress(new Address(
                street: $inputDto->address->street,
                number: $inputDto->address->number,
                neighborhood: $inputDto->address->neighborhood,
                complement: $inputDto->address->complement,
                city: $inputDto->address->city,
            ));
        }

        $response = $this->repository->insert($contract);

        // Return output DTO
        return new CreateContractOutputDto(
            id: $response->id(),
            activationDate: $contract->activationDate(),
            renewalDate: $contract->renewalDate(),
            contractStatus: $response->contractStatus->value,
            internetStatus: $response->internetStatus->value,
            idExternal: $response->idExternal,
            street: $contract->address()?->street,
            number: $contract->address()?->number,
            neighborhood: $contract->address()?->neighborhood,
            complement: $contract->address()?->complement,
            city: $contract->address()?->city,
        );
    }
}
