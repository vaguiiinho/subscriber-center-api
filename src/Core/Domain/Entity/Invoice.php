<?php

namespace Core\Domain\Entity;

use Core\Domain\Enum\InvoiceReceiptType;
use Core\Domain\Enum\InvoiceStatus;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Invoice extends Entity
{

    public function __construct(
        protected DateTime $emissionDate,
        protected DateTime $maturityDate,
        protected float $amount,
        protected InvoiceReceiptType $receiptType,
        protected InvoiceStatus $status,
        protected string $idExternal,
        protected ?Uuid $id = null,
    ) {
        $this->id = $this->id ?? Uuid::random();
    }

    public function emissionDate()
    {
        return $this->emissionDate->format('Y-m-d');
    }

    public function maturityDate()
    {
        return $this->maturityDate->format('Y-m-d');
    }
}
