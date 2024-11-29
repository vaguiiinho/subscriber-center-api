<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'emissionDate' => $this->emissionDate,
            'maturityDate' => $this->maturityDate,
            'amount' => $this->amount,
            'receiptType' => $this->receiptType,
            'status' => $this->status,
            'idExternal' => $this->idExternal
        ];
    }
}
