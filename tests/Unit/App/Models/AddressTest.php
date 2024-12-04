<?php

namespace Tests\Unit\App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidTrait;

class AddressTest extends ModelTestCase
{
    protected function model(): Model
    {
        return new Address();
    }

    protected function traits(): array
    {
        return [
            HasFactory::class,
            UuidTrait::class,
        ];
    }

    protected function fillable(): array
    {
        return [
            'street',
            'number',
            'neighborhood',
            'complement',
            'city',
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
