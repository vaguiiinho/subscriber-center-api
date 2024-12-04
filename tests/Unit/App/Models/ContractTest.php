<?php

namespace Tests\Unit\App\Models;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractTest extends ModelTestCase
{
    protected function model(): Model
    {
        return new Contract();
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
            'activationDate',
            'renewalDate',
            'contractStatus',
            'internetStatus',
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
