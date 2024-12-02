<?php

namespace Tests\Unit\Domain\Entiry;

use Core\Domain\Entity\Contract;
use Core\Domain\Entity\Invoice;
use Core\Domain\Enum\ContractStatus;
use Core\Domain\Enum\InternetStatus;
use Core\Domain\Enum\InvoiceReceiptType;
use Core\Domain\Enum\InvoiceStatus;
use Core\Domain\ValueObject\Address;
use DateTime;
use PHPUnit\Framework\TestCase;

class ContractUnitTest extends TestCase
{
    public function testAttributes()
    {
        $contract = new Contract(
            activationDate: new DateTime('2023-12-15'),
            renewalDate: new DateTime('2024-01-01'),
            contractStatus: ContractStatus::ACTIVE,
            internetStatus: InternetStatus::ACTIVE,
            idExternal: '10',
            address: new Address(
                street: '123 Main St',
                number: '456',
                neighborhood: 'Downtown',
                complement: 'Apt 789',
                city: 'Springfield'
            ),
        );

        $this->assertNotEmpty($contract->id);
        $this->assertEquals('2023-12-15', $contract->activationDate());
        $this->assertEquals('2024-01-01', $contract->renewalDate());
        $this->assertEquals(ContractStatus::ACTIVE, $contract->contractStatus);
        $this->assertEquals(InternetStatus::ACTIVE, $contract->internetStatus);
        $this->assertEquals('10', $contract->idExternal);
        $this->assertInstanceOf(Address::class, $contract->address);
    }

    public function testAttributesNotAddress()
    {
        $contract = new Contract(
            activationDate: new DateTime('2023-12-15'),
            renewalDate: new DateTime('2024-01-01'),
            contractStatus: ContractStatus::ACTIVE,
            internetStatus: InternetStatus::ACTIVE,
            idExternal: '10',
        );

        $this->assertNotEmpty($contract->id);
    }
}
