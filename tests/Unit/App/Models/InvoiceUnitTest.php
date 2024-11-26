<?php

namespace Tests\Unit\App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceUnitTest extends ModelTestCase
{
    protected function model(): Model
    {
        return new Invoice();
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
            'emissonDate',
            'maturityDate',
            'amount',
            'receipt_type',
            'status',
            'id_external',
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
            'is_active' => 'boolean',
            'deleted_at' => 'datetime',
        ];
    }
}