<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class FilterOrders implements Rule
{
    private $request, $message;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function passes($attribute, $value)
    {
        if (($this->request->Filtro == null)&&($this->request->Buscar!=null)) {
            $this->message = 'El filtro es obligatorio';
            return false;
        }

        if (($this->request->Filtro == 'DEPOSITO')&&($this->request->Buscar!=null)) {
            $this->message = 'El filtro por depósito no lleva argumento';
            return false;
        }

        if (($this->request->Filtro == 'ORDEN')&&($this->request->Buscar!=null)) {
            $this->request->validate(
                [
                    'Buscar' => ['numeric'],
                ],
                $messages = [
                    'Buscar.numeric' => 'El argumento debe ser numérico',
                ]
            );
        }

        if (($this->request->Filtro == 'MONTO')&&($this->request->Buscar!=null)) {
            $this->request->validate(
                [
                    'Buscar' => [new Decimals(5,2)],
                ]
            );
        }

        if (($this->request->Filtro == 'CLIENTE')&&($this->request->Buscar!=null)) {
            $this->request->validate(
                [
                    'Buscar' => ['alpha'],
                ]
            );
        }
        return true;
    }


    public function message()
    {
        return $this->message;
    }
}
