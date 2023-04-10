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
            'secret' => "6LcNs3MlAAAAAF_JtHmcxIYfXP2bQDcafoo8_kaU",
            'response' => $value,
        ]);

        return $response->json()['success'];
    }

    public function message()
    {
        return 'Please verify that you are not a robot.';
    }
}
