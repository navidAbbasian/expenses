<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListItemResource extends JsonResource
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
            'list_title_id' => $this->list_title_id,
            'name'=> $this->name,
            'is_complete' => $this->is_complete,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
