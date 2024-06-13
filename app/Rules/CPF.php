<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CPF implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^\d{11}$/', $value)) {
            $fail('O CPF deve conter 11 dígitos.');
            return;
        }

        $primeiroDigito = 0;
        $segundoDigito = 0;

        for ($i = 0; $i <= 8; $i++) {
            $primeiroDigito += $value[$i] * (10 - $i);
        }

        $primeiroDigito = $primeiroDigito % 11;

        if ($primeiroDigito < 2) {
            $primeiroDigito = 0;
        } else {
            $primeiroDigito = 11 - $primeiroDigito;
        }

        for ($i = 0; $i <= 9; $i++) {
            $segundoDigito += $value[$i] * (11 - $i);
        }

        $segundoDigito = $segundoDigito % 11;

        if ($segundoDigito < 2) {
            $segundoDigito = 0;
        } else {
            $segundoDigito = 11 - $segundoDigito;
        }

        if ($value[9] != $primeiroDigito || $value[10] != $segundoDigito) {
            $fail('O CPF fornecido é inválido.');
        }
    }
}
