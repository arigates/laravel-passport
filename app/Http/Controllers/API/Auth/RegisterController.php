<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * User register
     * 
     * @param \Illuminate\Http\Request UserRegisterRequest
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        unset($data['c_password']);
        $user = User::create($data);
        $user->sendEmailVerificationNotification();
        return response()->json(
            [
                'status' => true,
                'data' => 'Registrasi berhasil, silahkan konfirmasi email'
            ], 200
        );
    }
}
