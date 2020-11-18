<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

trait EnterpriseRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name'          => 'required|min:2|max:60',
            'phone'         => 'required|min:9|max:15',
            'contactperson' => 'required|min:2|max:100',
            'taxnumber'     => 'required|between: 5,20',
            'address'       => 'required|min:20', // nullable = no requerido
        ];
    }
    
    public function messages() {
        $required = 'El campo :attribute es obligatorio.';
        $min      = 'El campo :attribute no tiene la longitud mínima requerida :min';
        $max      = 'El campo :attribute supera la longitud máxima requerida :max';
        $between  = 'El campo :attribute debe tener entre :min y :max caracteres.';
        return [
                'name.required'          => $required,
                'name.min'               => $min,
                'name.max'               => $max,
                'phone.required'         => $required,
                'phone.min'              => $min,
                'phone.max'              => $max,
                'contactperson.required' => $required,
                'contactperson.min'      => $min,
                'contactperson.max'      => $max,
                'taxnumber.required'     => $required,
                'taxnumber.between'      => $between,
                'address.required'       => $required,
                'address.min'            => $min,
            ];
    }
    
    public function attributes() {
        return [
            'name'          => 'nombre de la empresa',
            'phone'         => 'número de teléfono',
            'contactperson' => 'persona de contacto',
            'taxnumber'     => 'código de identificación fiscal',
            'address'       => 'dirección de la empresa',
            ];
    }
}
