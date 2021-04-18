<?php

namespace Madsis\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UpdateUserProfileRequest extends FormRequest
{

    public function authorize(){
        return true;
    }

    protected $rules = [
        'IDTFECNACIMIENTO' => 'required|date',
        'CATESTADOCIVIL' => 'required',
        'CATGENERO' => 'required',
        'IDTTELEFONO' => 'required',
        'IDTCELULAR' => 'required',
        'UBCPROVINCIA' => 'required',
        'UBCCANTON' => 'required',
        'UBCPARROQUIA' => 'required',
        'IDTDIRECCION' => 'required',
        //'imagen' => 'required',
    ];

    public function rules(){
        $rules = $this->rules;
        $IDTIMGURL = Auth::user()->identificacion()->first()->IDTIMGURL;
        if($IDTIMGURL=='/images/user/'){
            $rules['imagen'] = 'bail|required';
        }
        return $rules;
    }

    protected $messages = [
        'IDTFECNACIMIENTO.required' => 'Fecha de nacimiento es obligatoria.',
        'CATESTADOCIVIL.required' => 'El estado civil es obligatorio.',
        'CATGENERO.required' => 'El género es obligatorio.',
        'IDTTELEFONO.required' => 'El telf del domicilio es obligatorio.',
        'IDTCELULAR.required' => 'El telf móvil es obligatorio.',
        'UBCPROVINCIA.required' => 'La provincia es obligatoria',
        'UBCCANTON.required' => 'El cantón es obligatorio',
        'UBCPARROQUIA.required' => 'La parroquia es obligatoria',
        'IDTDIRECCION.required' => 'La direccion es requerida',
        'imagen.required' => 'La foto del usuario es requerida',
    ];

    public function messages(){
        return $this->messages;
    }
}
