<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'required',
            'password'  => 'required|min:8',
            'c_password'=> 'required|same:password'
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
            'name.required'         => 'Nama wajib isi!',
            'name.string'           => 'Nama wajib menggunakan huruf',
            'name.max'              => 'Nama tidak boleh lebih dari 255 karakter',
            'email.required'        => 'Email wajib isi!',
            'email.email'           => 'Format email tidak valid',
            'email.unique'          => 'Email sudah digunakan',
            'phone.required'        => 'Nomor telepon wajib isi!',
            'password.required'     => 'Password wajib isi',
            'password.min'          => 'Minimal panjang password 8 karakter',
            'c_password.required'   => 'Konfirmasi password wajib isi',
            'c_password.same'       => 'Konfirmasi password salah'
        ];
    }
}
