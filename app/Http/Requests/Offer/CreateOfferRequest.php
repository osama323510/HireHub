<?php

namespace App\Http\Requests\Offer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ForbiddenWords;
class CreateOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'offer_price'=>'numeric|decimal:0,2|required|min:1',
            'description'=>"string",new ForbiddenWords,
            'days'=>"integer|required|min:2",
            'post_id'=>'required',
            
        ];
    }
}
