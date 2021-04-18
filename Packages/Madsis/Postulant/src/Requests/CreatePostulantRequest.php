<?php

namespace Madsis\Postulant\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Madsis\Api\Rules\Cedula;
use Madsis\Api\Rules\EmailUnique;
use Madsis\Api\Rules\Ruc;
use Madsis\Api\Rules\TwoWords;

class CreatePostulantRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected $rules = [
        'ndocumento' => 'required|string|max:11',
        'nombres' => 'required|string|max:50',
        'password' => 'required|string|max:50',
        'apellidos' => 'required|string|max:50',
        'fecnacimiento' => 'required|date',
        'telfmovil' => 'required|max:15',
        'provincia' => 'required',
        'canton' => 'required',
        'parroquia' => 'required',
    ];

    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
            {
                $rules = $this->rules;
                $data = array_merge($this->request->all(),[
                    'fecnacimiento' =>  date("Y-m-d",strtotime($this->request->get('fecnacimiento'))),
                ]);
                $rules['email'] = [
                    'bail','email','required',new EmailUnique('User','email')
                ];

                $this->request->replace($data);    
                return $rules;
            }

            default:break;
        }
    }

    protected $messages = [
        'nacionalidad.required' => 'La nacionalidad es obligatoria.',
        'tipodocumento.required' => 'El tipo de documento es obligatorio.',
        'ndocumento.unique' => 'El No. de documento ya ha sido registrado.',
        'ndocumento.required' => 'El No. de documento es obligatorio.',
        'nombres.required' => 'Los nombres son obligatorios.',
        'nombres.max' => 'Los nombres no deben exceder 50 caracteres.',
        'apellidos.required' => 'Los apellidos son obligatorios.',
        'apellidos.max' => 'Los apellidos no deben exceder 50 caracteres.',
        'username.required'  => 'El usuario es obligatorio.',
        'username.unique'  => 'El usuario ya existe.',
        'perfil.required' =>'El perfil es obligatorio.',
        'password.required' =>'La contraseña es obligatoria.',
        'supervisor.required' => 'El usuario padre es requerido',
        'supervisor.required_if' => 'El :attribute es requerido',
        'ndocumento.cedula' => 'El No. de cédula es invalido',
        'ndocumento.digits' => 'El No. de cédula debe tener 10 dígitos',
        'ndocumento.ruc' => 'El No. de ruc es invalido',
        'fec_ingreso.required' => 'Fecha de ingreso es obligatoria.',
        'fecnacimiento.required' => 'Fecha de nacimiento es obligatoria.',
        'fecnacimiento.date' => 'Formato Inválido.',
        'fecnacimiento.date_format' => 'Formato Inválido.',
        'estadocivil.required' => 'El estado civil es obligatorio.',
        'genero.required' => 'El género es obligatorio.',
        'telfdomicilio.required' => 'El teléfono del domicilio es obligatorio.',
        'telfmovil.required' => 'El teléfono móvil es obligatorio.',
        'cto_emergencia.required' => 'El contacto de emergencia es obligatorio',
        'tlf_emergencia.required' => 'El telf de emergencia es obligatorio',
        'provincia.required' => 'La provincia es obligatoria',
        'canton.required' => 'El cantón es obligatorio',
        'parroquia.required' => 'La parroquia es obligatoria',
        'cod_postal.required' => 'El código postal es obligatorio',
        'cod_postal.numeric' => 'El código postal debe ser numérico',
        'cod_postal.digits' => 'El código postal debe tener 6 dígitos',
        'calle_primaria.required' => 'La calle primaria es requerida',
        'calle_secundaria.required' => 'La calle secundaria es requerida',
        'imagen.required' => 'Tu foto de perfil es requerida',
        'hojavida.required' => 'La hoja de vida es requerida',
        'referencia.required' => 'La referencia es requerida',
        'googlecaptcha.required' => 'La Captcha es requerida',

    ];

    public function messages()
    {
        $messages = $this->messages;
        if ($this->request->get('tipo_documento')==3)//Cuando es ruc
        {
            $messages['ndocumento.digits'] = 'El No. de ruc debe tener 13 dígitos';
        }
        return $messages;
    }
}
