<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;

class Ruc implements Rule
{
    public function passes($attribute, $value)
    {
        $codprovincia= substr($value, 0, 2);

        if ($codprovincia < 0 OR $codprovincia > 24) {
            return false;
        }

        $tercerdigito= $value[2];

        if ($tercerdigito < 0 OR $tercerdigito > 5 OR $tercerdigito==6 OR $tercerdigito==9 ) {
            return false;
        }
        return true;
    }

    protected $message = [
        'El ruc es inválido.'
    ];

    public function message()
    {
        return $this->message;
    }
}
