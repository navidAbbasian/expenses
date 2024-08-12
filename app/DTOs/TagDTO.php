<?php

namespace App\DTOs;

use App\Http\Requests\CreateBankRequest;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Http\Requests\UpdateTagRequest;


class TagDTO extends DataTransformerObject
{
    public function __construct(
        readonly ?string $name = null,
        readonly ?string $description = null,

    )
    {
        parent::__construct();

    }

    public static function fromRequest(CreateTagRequest|UpdateTagRequest $request): static
    {
        return new static(
            name: $request->name,
            description: $request->description,
        );
    }
}
