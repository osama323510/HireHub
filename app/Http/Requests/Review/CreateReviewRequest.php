<?php

namespace App\Http\Requests\Review;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
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
    public function rules(): array
    {
        return [ 
            "comment"         => "nullable|string|max:500",
            "rating"          => "required|integer|min:1|max:5",
            "reviewable_id"   => "required|integer",
            "reviewable_type" => "required|string|in:freelancer,post",  
        ];
    }
}
