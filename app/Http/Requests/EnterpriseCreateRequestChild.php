<?php

namespace App\Http\Requests;

use App\Http\Requests\EnterpriseEditRequest;
use Illuminate\Foundation\Http\FormRequest;

class EnterpriseCreateRequestChild extends EnterpriseEditRequest
{
    public function rules()
    {
        return array_merge(
            parent::rules(), 
            ['name' => 'required|min:2|max:60|unique:enterprise,name']
        );
    }
    
    public function messages() {
        $unique   = 'El campo :attribute debe ser único.';
        return array_merge(
            parent::messages(), 
            ['name.unique' => $unique]
        );
    }
}
