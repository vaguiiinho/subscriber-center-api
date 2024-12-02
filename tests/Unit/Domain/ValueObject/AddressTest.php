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

        // Act: 
        $result = $address->getAddress();

        // Assert: 
        $this->assertSame($address, $result);
    }
}
