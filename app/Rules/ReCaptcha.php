<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class ReCaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        $response = Http::get("https://www.google.com/recaptcha/api/siteverify", [
            'secret' => "6LfQ8mIlAAAAAPpnVaKuhU7n_BXdtIE63w2sJazs",
            'response' => $value,
        ]);

        return $response->json()['success'];
    }

    public function message()
    {
        return 'Please verify that you are not a robot.';
    }
}