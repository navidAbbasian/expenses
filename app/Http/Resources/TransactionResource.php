<?php

namespace App\Http\Resources;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'amount' => $this->amount,
            'description' => $this->description,
            'type' => $this->type,
            'from' => ($this->from != null)? Bank::find($this->from)->name : null,
            'to' => ($this->to != null)? Bank::find($this->to)->name : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
