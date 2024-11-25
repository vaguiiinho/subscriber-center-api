<?php

namespace Core\UseCase\Invoice\Create\Dto;

class CreateInvoiceInputDto
{
    public function __construct(
        public string $emissonDate,
        public string $maturityDate,
        public float $amount,
        public string $receiptType,
        public string $status,
        public string $idExternal,
    ) {}
}
