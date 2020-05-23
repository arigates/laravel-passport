<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'token'     => 'required',
            'email'     => 'required|email',
            'password'  => 'required|confirmed|min:8',
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
            'email.required'=> 'Email wajib isi!',
            'email.email'   => 'Email tidak valid!',
            'token.required'=> 'Token wajib isi',
            'password.required' => 'Password wajib isi',
            'password.min'  => 'Panjang password minimal 8 karakter',
            'password.confirmed' => 'Ulangi ketik password'
        ];
    }
}
