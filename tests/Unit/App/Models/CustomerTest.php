<?php

namespace Tests\Unit\App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    SoftDeletes,
    Model,
};

class CustomerTest extends ModelTestCase
{
    protected function model(): Model
    {
        return new Customer();
    }

    protected function traits(): array
    {
        return [
            HasFactory::class,
            SoftDeletes::class,
        ];
    }

    protected function fillable(): array
    {
        return [
            'id',
            'active',
            'name',
            'cnpj_cpf',
            'birthDate',
            'registrationDate',
            'idExternal'
        ];
    }

    protected function incrementing(): bool
    {
        return false;
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'deleted_at' => 'datetime',
        ];
    }
}
