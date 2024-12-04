<?php

namespace Tests\Unit\Core\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use Core\Domain\ValueObject\Address;

class AddressTest extends TestCase
{
    public function testGetAddressReturnsSelf()
    {
        // Arrange: 
        $address = new Address(
            street: '123 Main St',
            number: '456',
            neighborhood: 'Downtown',
            complement: 'Apt 789',
            city: 'Springfield'
        );

        // Assert: 
        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('123 Main St', $address->street);
        $this->assertEquals('456', $address->number);
        $this->assertEquals('Downtown', $address->neighborhood);
        $this->assertEquals('Apt 789', $address->complement);
        $this->assertEquals('Springfield', $address->city);
    }
}
