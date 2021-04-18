<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProductsRule implements Rule
{
    public function passes($attribute, $value)
    {
        if ($this->key == 'marca') {
            return ctype_alpha( $this->valor);
        }
        return true;
    }

    public function message()
    {
        return 'Cirilo ' ;
    }

}
