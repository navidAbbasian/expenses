<?php

namespace App\DTOs;

class ListItemDTO extends DataTransformerObject
{
    public function __construct(
        readonly string $list_title_id,
        readonly string $name,
        readonly string $is_complete,

    )
    {
        parent::__construct();

    }

    public static function fromRequest($request): static
    {
        return new static(
            list_title_id: $request->list_title_id,
            name: $request->name,
            is_complete: $request->is_complete,
        );
    }
}
