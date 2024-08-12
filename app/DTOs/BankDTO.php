<?php

namespace App\DTOs;

use App\Http\Requests\CreateBankRequest;
use App\Http\Requests\UpdateBankRequest;


class BankDTO extends DataTransformerObject
{
    public function __construct(
        readonly ?string $name = null,
        readonly ?string $account_number = null,

    )
    {
        parent::__construct();

    }

    public static function fromRequest(CreateBankRequest|UpdateBankRequest $request): static
    {
        return new static(
            name: $request->name,
            account_number: $request->account_number,
        );
    }
}
