<?php

namespace Core\Domain\Enum;

enum InternetStatus: string
{
    case ACTIVE = 'A';
    case DISABLED = 'D';
    case MANUALLOCK = 'CM';
    case AUTOMATICLOCK = 'CA';
    case FINANCIALDELAY = 'FA';
    case AWAITINGSIGNATURE = 'AA';
}
