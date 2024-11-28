<?php

namespace Tests\Unit\Domain;

use Core\Domain\Entity\Invoice;
use Core\Domain\Enum\InvoiceReceiptType;
use Core\Domain\Enum\InvoiceStatus;
use Core\Domain\ValueObject\DateValueObject;
use PHPUnit\Framework\TestCase;

class InvoiceUnitTest extends TestCase
{
    public function testAttributes(): void
    {
        $invoice = new Invoice(
            emissionDate: new DateValueObject('2023-12-15'),
            maturityDate: new DateValueObject('2023-12-20'),
            amount: 100,
            receiptType: InvoiceReceiptType::PIX,
            status: InvoiceStatus::RECEIVED,
            idExternal: '10'
        );
        $this->assertNotEmpty($invoice->id);
        $this->assertEquals('2023-12-15', $invoice->emissionDate());
        $this->assertEquals('2023-12-20', $invoice->maturityDate());
        $this->assertEquals(100, $invoice->amount);
        $this->assertEquals(InvoiceReceiptType::PIX, $invoice->receiptType);
        $this->assertEquals(InvoiceStatus::RECEIVED, $invoice->status);
        $this->assertEquals('10', $invoice->idExternal);
    }
}
