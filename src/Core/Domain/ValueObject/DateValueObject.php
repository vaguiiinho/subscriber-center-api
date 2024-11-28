<?php

namespace Core\Domain\ValueObject;

use DateTime;
use InvalidArgumentException;

class DateValueObject
{
    private DateTime $date;

    public function __construct(string $date)
    {
        $this->validate($date);
        $this->date = new DateTime($date);
    }

    /**
     * Valida o formato da data.
     */
    private function validate(string $date): void
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        if (!$d || $d->format('Y-m-d') !== $date) {
            throw new InvalidArgumentException("Invalid date format, expected 'Y-m-d'.");
        }
    }


    /**
     * Método mágico para representar como string.
     */
    public function __toString(): string
    {
        return $this->date->format('Y-m-d');
    }
}
