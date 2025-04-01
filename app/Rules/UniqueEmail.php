<?php

namespace App\Rules;

use App\Models\Profile;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Translation\PotentiallyTranslatedString;

class UniqueEmail implements ValidationRule
{
    protected mixed $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Profile::query()->where('email', $value);

        if ($this->userId) {
            $query->where('id', '!=', $this->userId);
        }

        if ($query->exists()) {
            $fail('Данная почта уже используется другим пользователем.');
        }
    }
}
