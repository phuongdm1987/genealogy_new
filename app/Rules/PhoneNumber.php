<?php

namespace Genealogy\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $firstNumber = mb_substr($value, 0, 2);

        if (($firstNumber == '09' || $firstNumber == '08') && strlen($value) == 10) {
            return preg_match("/^\d{10}/", $value);
        } elseif ($firstNumber == '01' && strlen($value) == 11) {
            return preg_match("/^\d{11}/", $value);
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.phone_number');
    }
}
