<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    SoftDeletes,
    Model,
};

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'active',
        'personType',
        'name',
        'cnpj_cpf',
        'birthDate',
        'registrationDate',
        'idExternal',
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
        'deleted_at' => 'datetime',
    ];
}
