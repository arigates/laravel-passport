<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email'     => 'required|email',
            'password'  => 'required|min:8',
            'remember'  => 'present'
        ];
    }

    /**
     * Validation messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'    => 'Email wajib isi!',
            'email.email'       => 'Email tidak valid',
            'password.required' => 'Password wajib isi!',
            'password.min'      => 'Panjang password minimal 8 karakter',
            'remember.present'  => 'Kolom ingat saya wajib isi saat request'      
        ];
    }
}
