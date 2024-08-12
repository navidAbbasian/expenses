<?php

namespace App\Http\Requests;

use App\Enums\TransactionTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required'],
            'description' => ['string'],
            'type' => ['required', Rule::in(TransactionTypeEnum::values())],
            'from' => [Rule::exists(table: 'banks', column: 'id'),
                Rule::prohibitedIf($this->to != null),
                Rule::prohibitedIf($this->type == 'income')],
            'to' => [Rule::exists(table: 'banks', column: 'id'),
                Rule::prohibitedIf($this->from != null),
                Rule::prohibitedIf($this->type == 'cost')],
        ];
    }
}
