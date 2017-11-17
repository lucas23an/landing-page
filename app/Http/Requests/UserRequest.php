<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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
            'name' => 'required', 
            'email' => 'required',
            'phone' => 'required',
            'birthdate' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'uf' => 'required',
            'zip_code' => 'required'
        ];
    }

    public function messages()
    {
        $messages =  [
            'name.required' => 'Campo nome é obrigatório.',
            'email.required' => 'Campo email é obrigatório.',
            'email.unique' => 'O email já está sendo utilizado.',
            'phone.required' => 'Campo telefone é obrigatório.',
            'birthdate.required' => 'Campo data de nascimento é obrigatório.',
            'address.required' => 'Campo endereço é obrigatório.',
            'neighborhood.required' => 'Campo Bairro é obrigatório.',
            'city.exists' => 'Campo cidade é obrigatório.',
            'uf.exists' => 'Campo estado é obrigatório.',
            'zip_code.exists' => 'Campo CEP é obrigatório.'
        ];

        return $messages;
    }
}
