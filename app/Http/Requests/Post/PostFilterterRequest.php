<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostFilterterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */


    protected function prepareForValidation(): void
    {
        $this->merge([
        'newpost'        => filter_var($this->newpost, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        'thisMonth'      => filter_var($this->thisMonth, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),        
        ]);
    }


    public function rules(): array
    {
        return [
        'newpost' => 'sometimes|boolean',
        'thisMonth'      => 'sometimes|boolean',
        'budgetlimit'       => 'sometimes|integer',
        ];
    }
}


