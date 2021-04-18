<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailUnique implements Rule
{
    private $parameter = '', $namespace = '';
    protected $message = [
        'El email ya existe'
    ];
    function __construct($namespace, $parameter) {
        $this->parameter = $parameter;
        $this->namespace = $namespace;
    }
    public function passes($attribute, $value)
    {
        if ($this->namespace == 'User'){
           $this->namespace = 'Madsis\User\Models\User';
        }

        if ($this->namespace == 'Postulant'){
            $this->namespace = 'Madsis\Postulant\Models\Postulant';
        }

        $response = $this->namespace::where($this->parameter,strtoupper($value))->orwhere($this->parameter,strtolower($value))->exists();

        return !$response;
    }

    public function message()
    {
        return $this->message;
    }
}
