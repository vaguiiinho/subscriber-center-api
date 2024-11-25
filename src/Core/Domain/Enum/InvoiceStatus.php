<?php

namespace Core\Domain\Enum;

enum InvoiceStatus: string
{
    case RECEIVABLE = 'A';
    case RECEIVED = 'R';
    case PARTIAL = 'P';
    case CANCELED = 'C';
}
