<?php

namespace Core\Domain\ValueObject;

class Address
{
    public function __construct(
        protected string $street,
        protected string $number,
        protected string $neighborhood,
        protected string $complement,
        protected string $city,
    ) {}

    public function getAddress(): self
    {
        return $this;
    }
}


