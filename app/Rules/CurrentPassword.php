<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class CurrentPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Session::has('user') || !Hash::check($value, Session::get('user')->password)) {
            $fail('Введённый пароль не совпадает с текущим паролем.');
        }
    }

}
