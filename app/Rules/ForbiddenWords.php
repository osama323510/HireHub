<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ForbiddenWords implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): 
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $badWords = ['badword1', 'badword2'];
        foreach ($badWords as $word) {
            
            if (str_contains(mb_strtolower($value), mb_strtolower($word))) {
                $fail("contain bad words");
                break;
            }
        }
    }
}
