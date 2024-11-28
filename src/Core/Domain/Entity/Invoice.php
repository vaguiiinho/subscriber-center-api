<?php

namespace Core\Domain\Entity;

use Core\Domain\Enum\InvoiceReceiptType;
use Core\Domain\Enum\InvoiceStatus;
use Core\Domain\ValueObject\DateValueObject;
use Core\Domain\ValueObject\Uuid;

class Invoice extends Entity
{

    public function __construct(
        protected DateValueObject $emissionDate,
        protected DateValueObject $maturityDate,
        protected float $amount,
        protected InvoiceReceiptType $receiptType,
        protected InvoiceStatus $status,
        protected string $idExternal,
        protected ?Uuid $id = null,
    ) {
        $this->id = $this->id ?? Uuid::random();
    }
}

