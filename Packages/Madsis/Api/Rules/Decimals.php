<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;

class Decimals implements Rule
{
    private $parameters = array();

    public function __construct($parameters1,$parameters2)
    {
        $this->parameters[0] = $parameters1;
        $this->parameters[1] = $parameters2;
    }

    public function passes($attribute, $value)
    {
        return preg_match("/^[0-9]{1,{$this->parameters[0]}}(\.[0-9]{1,{$this->parameters[1]}})$/", $value);
    }

    public function example()
    {
        return mt_rand(1, (int) str_repeat('9', $this->parameters[0])) .
            '.' .
            mt_rand(1, (int) str_repeat('9', $this->parameters[1]));
    }

    public function message()
    {
        return 'Formato incorrecto ' . $this->example();
    }

}
