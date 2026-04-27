<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ForbiddenWords;
class CreatePostRequest extends FormRequest
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
        'title'       => trim($this->title),
        'description' => trim($this->description),
    ]);
}

public function rules(): array
{
    return [
        'title' => ['required','string','min:10','max:255',new ForbiddenWords()],
        'description' => ['required','string','min:50',new ForbiddenWords()],   
        'budget' => 'required|in:fixed,hourly',     
        'price' => 'required|numeric|min:1',       
        'deadline' => 'required|date|after:today',   
        'tags' => 'required|array|max:5',            
        'tags.*' => 'exists:tags,id',
    ];
}

public function messages()
{
    return [
        'deadline.after' => ' the deadline must be in future',
        'tags.max' => ' you cannot add more then 5 tags',
    ];
}
}

