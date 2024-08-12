<?php

namespace App\Http\Resources;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
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
            'name' => $this->name,
            'balance'=> $this->balance,
            'account_number' => $this->account_number,
            'account_owner' => $this->account_owner,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
