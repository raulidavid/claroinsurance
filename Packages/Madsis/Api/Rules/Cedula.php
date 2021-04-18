<?php

namespace Madsis\Api\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cedula implements Rule
{
    public function passes($attribute, $value)
    {
        $cie = substr($value, 0, 2);
        if ($cie == 30) {
            return true;
        }

        $codprovincia= substr($value, 0, 2);

        if ($codprovincia < 0 OR $codprovincia > 24) {
            return false;
        }

        $tercerdigito= $value[2];

        if ($tercerdigito < 0 OR $tercerdigito > 5) {
            return false;
        }

        $digitosIniciales=substr($value, 0, 9);
        $digitoVerificador=$value[9];
        $arrayCoeficientes = array(2,1,2,1,2,1,2,1,2);
        $digitoVerificador = (int)$digitoVerificador;
        $digitosIniciales = str_split($digitosIniciales);

        $total = 0;
        foreach ($digitosIniciales as $key => $value) {

            $valorPosicion = ( (int)$value * $arrayCoeficientes[$key] );

            if ($valorPosicion >= 10) {
                $valorPosicion = str_split($valorPosicion);
                $valorPosicion = array_sum($valorPosicion);
                $valorPosicion = (int)$valorPosicion;
            }

            $total = $total + $valorPosicion;
        }

        $residuo =  $total % 10;

        if ($residuo == 0) {
            $resultado = 0;
        } else {
            $resultado = 10 - $residuo;
        }

        if ($resultado != $digitoVerificador) {
            return false;
        }

        return true;
    }

    protected $message = [
        'La cédula es inválida.'
    ];

    public function message()
    {
        return $this->message;
    }
}
