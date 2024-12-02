<?php

namespace Core\Domain\Entity;

use Core\Domain\Enum\ContractStatus;
use Core\Domain\Enum\InternetStatus;
use Core\Domain\ValueObject\Address;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Contract extends Entity
{

    public function __construct(
        protected DateTime $activationDate,
        protected DateTime $renewalDate,
        protected ContractStatus $contractStatus,
        protected InternetStatus $internetStatus,
        protected string $idExternal,
        protected ?Address $address = null,
        protected ?Uuid $id = null,
    ) {
        $this->id = $this->id ?? Uuid::random();
    }

    public function activationDate()
    {
        return $this->activationDate->format('Y-m-d');
    }

    public function renewalDate()
    {
        return $this->renewalDate->format('Y-m-d');
    }
}
