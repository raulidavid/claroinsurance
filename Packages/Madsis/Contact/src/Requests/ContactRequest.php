<?php

namespace Madsis\Contact\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Madsis\Api\Rules\Cedula;
use Madsis\Api\Rules\Ruc;

class ContactRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    protected $rules = [
      'nacionalidad' => 'required|numeric',
      'tipodocumento' => 'required|numeric',
      'ndocumento' => 'required|unique:contacts,CTODOCUMENTO|unique:identificaciones,IDTNDOCUMENTO',
      'nombres' => 'required|string|max:50',
      'apellidos' => 'required|string|max:50',
      'email' => 'email|required|max:50',
      'telfdomicilio' => 'required|string|max:20',
      'telfmovil' => 'required|string|max:20',
      'provincia' => 'required|numeric',
      'canton' => 'required|numeric',
      'parroquia' => 'required|numeric',
      'direccion' => 'required|string|max:100',
      'supervisor' => 'required|numeric',
    ];

    public function rules()
    {
        $rules = $this->rules;

        if ($this->request->get('tipodocumento')==2)//Cuando es cedula
        {
            $rules['ndocumento'] = ['bail','required','numeric','unique:contacts,CTODOCUMENTO','digits:10', new Cedula()];
        }
        if ($this->request->get('tipodocumento')==3)//Cuando es ruc
        {
            $rules['ndocumento'] = ['bail','required','numeric','unique:contacts,CTODOCUMENTO','digits:13', new Ruc()];
        }
        if ($this->request->get('tipodocumento')==4){//Pasaporte
            $rules['ndocumento'] = 'bail|required|unique:contacts,CTODOCUMENTO';
        }
        return $rules;
    }

    protected $messages = [
        'nacionalidad.required' => 'La nacionalidad es obligatoria.',
        'tipodocumento.required' => 'El tipo de documento es obligatorio.',
        'ndocumento.unique' => 'El No. de documento ya existe.',
        'ndocumento.required' => 'El No. de documento es obligatorio.',
        'nombres.required' => 'Los nombres son obligatorios.',
        'nombres.max' => 'Los nombres no deben exceder 50 caracteres.',
        'apellidos.required' => 'Los apellidos son obligatorios.',
        'apellidos.max' => 'Los apellidos no deben exceder 50 caracteres.',
        'password.required' =>'La contrase??a es obligatoria.',
        'email.required'  => 'El email es obligatorio.',
        'email.unique'  => 'El email ya existe.',
        'ndocumento.cedula' => 'El No. de c??dula es invalido',
        'ndocumento.digits' => 'El No. de c??dula debe tener 10 d??gitos',
        'ndocumento.ruc' => 'El No. de ruc es invalido',
        'telfdomicilio.required' => 'El tel??fono del domicilio es obligatorio.',
        'telfmovil.required' => 'El tel??fono m??vil es obligatorio.',
        'provincia.required' => 'La provincia es obligatoria',
        'canton.required' => 'El cant??n es obligatorio',
        'parroquia.required' => 'La parroquia es obligatoria',
        'direccion.required' => 'La direcci??n es requerida',
        'supervisor.required' => 'El supervisor es requerido',
    ];

    public function messages()
    {
        $messages = $this->messages;
        if ($this->request->get('tipo_documento')==3)//Cuando es ruc
        {
            $messages['ndocumento.digits'] = 'El No. de ruc debe tener 13 d??gitos';
        }
        return $messages;
    }
}
