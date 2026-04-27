<?php

namespace App\Http\Requests\Freelancer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FreelancerFilterterRequest extends FormRequest
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
        'sort_by_rating' => filter_var($this->sort_by_rating, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        'available'      => filter_var($this->available, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        'verified'       => filter_var($this->verified, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),

        ]);
    }

    public function rules(): array
    {
        return [
        'sort_by_rating' => 'sometimes|boolean',
        'available'      => 'sometimes|boolean',
        'verified'       => 'sometimes|boolean',
        ];
    }
}

