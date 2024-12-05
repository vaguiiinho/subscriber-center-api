<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'activationDate' => $this->activationDate,
            'renewalDate' => $this->renewalDate,
            'contractStatus' => $this->contractStatus,
            'internetStatus' => $this->internetStatus,
            'idExternal' => $this->idExternal
        ];
    }
}
