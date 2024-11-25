<?php

namespace Core\Domain\Enum;

enum InvoiceReceiptType: string
{
    case PIX = 'P';
    case INVOICE = 'I';
    case ACCOUNTDEBIT = 'AB';
}
