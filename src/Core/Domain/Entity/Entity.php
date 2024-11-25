<?php

namespace Core\Domain\Entity;

use Core\Domain\Notification\Notification;
use Exception;

abstract class Entity
{
    protected $notification;
    
    public function __construct()
    {
        $this->notification = new Notification();
    }

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