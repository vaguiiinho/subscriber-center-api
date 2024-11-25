<?php

namespace Core\Domain\Entity\Traits;

use Exception;

trait MethodsMagicsTrait
{
    public function __get($property)
    {
        if (isset($this->{$property}))
            return $this->{$property};
        
        $className = get_class($this);
        throw new Exception("property {$property} not found in class {$className}");
    }

    public function id() {
        return (string) $this->id; 
    }

    public function emissonDate() {
        return $this->emissonDate->format('Y-m-d'); 
    }

    public function maturityDate() {
        return $this->maturityDate->format('Y-m-d'); 
    }
}