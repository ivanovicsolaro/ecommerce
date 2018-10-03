<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
{
     protected $redirectRoute = 'checkout.index';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
    {
        return [
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|string|email|max:100',
            'phone' => 'required|string|max:55',
            'localidad' => 'required|string|max:255',
            'calle' => 'required|string|max:255',
            'numero' => 'required|string|max:50',
            'codigo_postal' => 'required|string|max:10',
        ];
    }

    public function messages(){
        return [
            'firstname.required' => 'El nombre es requerido',
            'lastname.required' => 'El apellido es requerido',
            'email.required' => 'El email es requerido',
            'phone.required' => 'El teléfono es requerido',
            'localidad.required' => 'La ciudad es requerida',
            'calle.required' => 'La dirección es requerida',
            'numero.required' => 'La altura es requerida',
            'codigo_postal.required' => 'El código postal es requerido',
        ];
    }
}
