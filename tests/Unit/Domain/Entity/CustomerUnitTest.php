<?php

namespace Tests\Unit\Domain\Entiry;

use Core\Domain\Entity\Customer;
use Core\Domain\Enum\PersonType;
use Core\Domain\ValueObject\CnpjCpf;
use DateTime;
use PHPUnit\Framework\TestCase;

class CustomerUnitTest extends TestCase
{
    public function testAttributes()
    {
        $customer = new Customer(
            active: true,
            personType: PersonType::PHYSICAL,
            name: "client 1",
            cnpj_cpf: new CnpjCpf('00011122233'),
            birthDate: new DateTime('2023-12-15'),
            registrationDate: new DateTime('2023-12-20'),
            idExternal: '10'
        );

        $this->assertNotEmpty($customer->id);
        $this->assertEquals(true, $customer->active);
        $this->assertEquals(PersonType::PHYSICAL, $customer->personType);
        $this->assertEquals("client 1", $customer->name);
        $this->assertEquals('00011122233', (string)$customer->cnpj_cpf);
        $this->assertEquals('2023-12-15', $customer->birthDate());
        $this->assertEquals('2023-12-20', $customer->registrationDate());
        $this->assertEquals('10', $customer->idExternal);
    }
}
