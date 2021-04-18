<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileExist implements Rule
{
    protected $message = [
        //'El cuen tiene estado pendiente.'
    ];

    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        if($value=="undefined"){
            return false;
        }
        return true;
    }

    public function message()
    {
        return 'La hoja de vida es requerida';
    }
}
