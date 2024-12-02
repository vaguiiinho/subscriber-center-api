<?php

namespace Core\Domain\Enum;

enum ContractStatus: string
{
    case PRECONTRACT = 'P';
    case ACTIVE = 'A';
    case INACTIVE = 'I';
    case NEGATIVE = 'N';
    case GAVEUP = 'D';
}
