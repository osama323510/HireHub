<?php

namespace App\Http\Requests\Freelancer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFreelancerRequest extends FormRequest
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
        'name'       => trim($this->title),
        'lastname' => trim($this->description),
        'email' => trim($this->email),
        'address' => trim($this->address),
    ]);
}

public function rules(): array
    {
        return [
        'id'=>'integer|min:1',
        'name'       => 'sometimes|string|max:225',
        'lastname'   => 'sometimes|string|max:255',
        'email'      => 'sometimes|email|unique:users,email,' . auth()->id(),
        'password'   => 'sometimes|string|min:8',
        'phone'      => 'sometimes|string|max:12|regex:/^963[0-9]{9}$/',
        'hour_price' => 'sometimes|numeric',
        'bio'        => 'sometimes|string|max:500',
        'portfolio'  => 'sometimes|url',
        'image'      => 'sometimes|string',
        'address'    => 'sometimes|string',
        'skills'         => 'sometimes|array',
        'skills.*.id'    => 'required_with:skills|exists:skills,id',
        'skills.*.years' => 'required_with:skills|integer|min:1',
    ];

    }  
    
}
