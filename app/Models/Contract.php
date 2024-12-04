<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'activationDate',
        'renewalDate',
        'contractStatus',
        'internetStatus',
        'idExternal'
    ];

    public  $incrementing = false;

    protected $casts = [
        'id' => 'string',
        'deleted_at' => 'datetime',
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
