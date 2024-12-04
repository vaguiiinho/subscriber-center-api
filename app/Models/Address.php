<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'street',
        'number',
        'neighborhood',
        'complement',
        'city',
    ];

    public  $incrementing = false;

    protected $casts = [
        'id' => 'string',
        'deleted_at' => 'datetime',
    ];

    public function contract(): BelongsTo
    {   
        return $this->belongsTo(Contract::class);
    }
}
