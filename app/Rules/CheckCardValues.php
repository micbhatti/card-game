<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckCardValues implements Rule
{
    private $allowedValues = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'J', 'Q', 'K', 'A'];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = explode(' ', $value);
        foreach($value as $item) {
            if(!in_array($item, $this->allowedValues)) return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You must play with following separated by space. Allowed values are: 2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A';
    }
}
