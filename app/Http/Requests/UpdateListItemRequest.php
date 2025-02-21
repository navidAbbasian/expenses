<?php

namespace App\Http\Requests;

use App\Enums\ListTypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateListItemRequest extends FormRequest
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
            "name" => ["nullable", "string", "max:100", Rule::unique(table: 'list_items', column: 'name')->ignore($this->list_item)],
            "is_complete" => ["nullable", "boolean"],
        ];
    }
}
