<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArrayNotNull implements Rule
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
        if(is_array($value)){
            foreach ($value as $v)
                if($v === null)
                    return false;

            return true;
        }
        else
            return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attrubute is required.';
    }
}
