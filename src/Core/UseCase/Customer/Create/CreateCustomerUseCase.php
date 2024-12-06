<?php

namespace Core\UseCase\Customer\Create;

use Core\Domain\Entity\Customer;
use Core\Domain\Enum\PersonType;
use Core\Domain\Repository\CustomerRepositoryInterface;
use Core\Domain\ValueObject\CnpjCpf;
use Core\UseCase\Customer\Create\Dto\{
    CreateCustomerInputDto,
    CreateCustomerOutputDto
};
use DateTime;

class CreateCustomerUseCase
{

    public function __construct(protected CustomerRepositoryInterface $repository) {}

    public function execute(CreateCustomerInputDto $inputDto): CreateCustomerOutputDto
    {
        $customer = new Customer(
            active: true,
            personType: PersonType::from($inputDto->personType),
            name: $inputDto->name,
            cnpj_cpf: new CnpjCpf($inputDto->cnpj_cpf),
            birthDate: new DateTime($inputDto->birthDate),
            registrationDate: new DateTime($inputDto->registrationDate),
            idExternal: $inputDto->idExternal,
        );

        $response = $this->repository->insert($customer);

        // Return output DTO
        return new CreateCustomerOutputDto(
            id: $response->id(),
            active: $response->active,
            personType: $response->personType->value,
            name: $response->name,
            cnpj_cpf: (string)$response->cnpj_cpf,
            birthDate: $response->birthDate(),
            registrationDate: $response->registrationDate(),
            idExternal: $response->idExternal,
        );
    }
}
