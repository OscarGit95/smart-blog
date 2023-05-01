<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\User;



class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {   
        // dd($this->request);
        $email = '|required|email|unique:users,email,' . $this->email . ',id,status_id,1';

        return [
            'name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'age' => 'required|numeric|min:18',
            'username' => 'required|string|max:150',
            'email' => $email,
            'password' => 'required|confirmed|max:50',
        ];
    }

    public function messages(){
        return [
            "name.required" => "El nombre es requerido",
            "name.required" => "El nombre debe ser un texto",
            "name.required" => "El nombre no debe ser mayor a 150 caracteres",
            "last_name.required" => "El apellido es requerido",
            "last_name.required" => "El apellido debe ser un texto",
            "last_name.required" => "El apellido no debe ser mayor a 150 caracteres",
            "age.required" => "La edad es requerida",
            "age.numeric" => "La edad debe ser un número",
            "age.min" => "Debes ser mayor a 18 años",
            "username.required" => "El nombre de usuario es requerido",
            "username.required" => "El nombre de usuario debe ser un texto",
            "username.required" => "El nombre de usuario no debe ser mayor a 150 caracteres",
            "email.required" => "El correo electrónico es requerido",
            "email.email" => "El correo electrónico debe ser un correo válido",
            "email.unique" => "El correo electrónico ya ha sido registrado",
            "password.required" => "La contraseña es requerida",
            "password.max" => "La contraseña no debe ser mayor a 50 caracteres",
            "password.confirmed" => "La contraseña no coincide con la confirmación de contraseña",
            
        ];
    }
}
