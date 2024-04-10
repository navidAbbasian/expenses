<?php

namespace App\Http\Requests;

use App\Enums\TransactionTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use function Laravel\Prompts\table;

class TransactionRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'type' => ['required', Rule::in(TransactionTypeEnum::values())],
            'from' => ['required', Rule::exists(table:'banks',column:  'id')],
            'to' => [Rule::exists(table:'banks',column:  'id')],
        ];
    }
}
