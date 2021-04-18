<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;

class TwoWords implements Rule
{
    public function passes($attribute, $value)
    {
        if($attribute=='nombres'){
            $this->message = 'Mínimo 2 nombres son requeridos';
        }
        if($attribute=='apellidos'){
            $this->message = 'Mínimo apellidos son requeridos';
        }
        if(count(explode(' ', $value)) < 2){
            return false;
        }
        return true;
    }

    protected $message = [
        //'El cuen tiene estado pendiente.'
    ];

    public function message()
    {
        return $this->message;
    }
}
