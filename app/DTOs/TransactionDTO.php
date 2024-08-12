<?php

namespace App\DTOs;

use App\Http\Requests\CreateTransactionRequest;

class TransactionDTO extends DataTransformerObject
{
    public function __construct(
        public ?array $tag_ids = null,
        readonly ?string $amount = null,
        readonly ?string $fee = null,
        readonly ?string $description = null,
        readonly ?string $type = null,
        readonly ?string $from = null,
        readonly ?string $to = null,

    )
    {
        parent::__construct();

    }

    public static function fromRequest(CreateTransactionRequest $request): static
    {
        return new static(
            tag_ids: $request->tag_ids,
            amount: $request->amount,
            fee: $request->fee,
            description: $request->description,
            type: $request->type,
            from: $request->from,
            to: $request->to,
        );
    }
}
