<?php

namespace Tests\Feature\Core\UseCase\Invoice;

use App\Models\Invoice;
use App\Repositories\Eloquent\InvoiceEloquentRepository;
use Core\UseCase\Invoice\Create\CreateInvoiceUseCase;
use Core\UseCase\Invoice\Create\Dto\CreateInvoiceInputDto;
use Tests\TestCase;

class CreateInvoiceUseCaseTest extends TestCase
{
    public function testInsert()
    {
        $repository = new InvoiceEloquentRepository(new Invoice());


        $useCase = new CreateInvoiceUseCase($repository);

        $useCase->execute(
            new CreateInvoiceInputDto(
                emissionDate: '2023-12-15',
                maturityDate: '2023-12-20',
                amount: 100,
                receiptType: 'P',
                status: 'R',
                idExternal: '10'
            )
        );

        $this->assertDatabaseHas('invoices', [
            'emissionDate' => '2023-12-15 00:00:00',
           'maturityDate' => '2023-12-20 00:00:00',
            'amount' => 100,
           'receiptType' => 'P',
           'status' => 'R',
            'idExternal' => '10',
        ]);

    }
}
