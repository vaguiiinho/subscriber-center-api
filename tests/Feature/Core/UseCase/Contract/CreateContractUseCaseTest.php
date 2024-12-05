<?php

namespace Tests\Feature\Core\UseCase\Contract;

use App\Models\Contract;
use App\Repositories\Eloquent\ContractEloquentRepository;
use App\Repositories\Transaction\DBTransaction;
use Core\Domain\ValueObject\Address;
use Core\UseCase\Contract\Create\CreateContractUseCase;
use Core\UseCase\Contract\Create\Dto\CreateContractInputDto;
use Tests\TestCase;

class CreateContractUseCaseTest extends TestCase
{
    public function testInsert()
    {
        $repository = new ContractEloquentRepository(new Contract());


        $useCase = new CreateContractUseCase($repository, new DBTransaction());

        $useCase->execute(
            new CreateContractInputDto(
                activationDate: '2023-12-15',
                renewalDate: '2023-12-20',
                contractStatus: 'A',
                internetStatus: 'A',
                idExternal: '10'
            )
        );

        $this->assertDatabaseHas('contracts', [
            'activationDate' => '2023-12-15 00:00:00',
            'renewalDate' => '2023-12-20 00:00:00',
            'contractStatus' => 'A',
            'internetStatus' => 'A',
            'idExternal' => '10',
        ]);
    }

    public function testInsertWithAddress()
    {
        $repository = new ContractEloquentRepository(new Contract());
        $useCase = new CreateContractUseCase($repository, new DBTransaction());

        $useCase->execute(
            new CreateContractInputDto(
                activationDate: '2023-12-15',
                renewalDate: '2023-12-20',
                contractStatus: 'A',
                internetStatus: 'A',
                idExternal: '10',
                address: new Address(
                    street: '123 Main St',
                    number: '456',
                    neighborhood: 'Downtown',
                    complement: 'Apt 789',
                    city: 'New York',
                )
            )
        );

        $this->assertDatabaseHas('contracts', [
            'idExternal' => '10',
        ]);

        $this->assertDatabaseHas('addresses', [
            'street' => '123 Main St',
            'number' => '456',
            'neighborhood' => 'Downtown',
            'complement' => 'Apt 789',
            'city' => 'New York',
        ]);
    }
}
