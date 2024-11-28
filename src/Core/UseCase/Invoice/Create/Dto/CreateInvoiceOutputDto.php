<?php

namespace Core\UseCase\Invoice\Create\Dto;

class CreateInvoiceOutputDto
{
    public function __construct(
        public string $id,
        public string $emissionDate,
        public string $maturityDate,
        public float $amount,
        public string $receiptType,
        public string $status,
        public string $idExternal,
    ) {}
}
