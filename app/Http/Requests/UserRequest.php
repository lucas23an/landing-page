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
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'birthdate' => 'required|date',
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
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.unique' => 'O email informado já está cadastrado.',
            'phone.required' => 'O campo telefone é obrigatório.',
            'birthdate.required' => 'O campo data de nascimento é obrigatório.',
            'address.required' => 'O campo endereço é obrigatório.',
            'neighborhood.required' => 'O campo Bairro é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
            'uf.required' => 'O campo estado é obrigatório.',
            'zip_code.required' => 'O campo CEP é obrigatório.',
            'birthdate.date' => "O campo data de nascimento, deve ser uma data válida"
        ];

        return $messages;
    }
}
