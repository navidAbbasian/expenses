<?php

namespace App\DTOs;


class ListTitleDTO extends DataTransformerObject
{
    public function __construct(
        readonly ?string $name = null,
        readonly ?string $type = null,

    )
    {
        parent::__construct();

    }

    public static function fromRequest($request): static
    {
        return new static(
            name: $request->name,
            type: $request->type,
        );
    }
}
