<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    /**
     * User Login
     * Request $request
     * 
     * @param \Illuminate\Http\Request UserLoginRequest
     * @return \Illuminate\Http\Response Login Status and token
     */
    public function login(UserLoginRequest $request)
    {
        $validator  = Validator::make([], []);
        $data       = $request->all();
        $email      = $data['email'];
        $password   = $data['password'];
        $remember   = $data['remember'];
        $user       = User::where('email', $email)->first();
        
        if ($user) {
            $auth = Auth::attempt(['email' => $email, 'password' => $password], $remember);
            if ($auth) {
                $user       = Auth::user();
                $response   = [
                    'status'=> true,
                    'data'  => $user->createToken('SimplePOS')->accessToken
                ];
                return response()->json($response, 200);
            } else {
                $validator->getMessageBag()->add('password', 'Password salah');
            }
        } else {
            $validator->getMessageBag()->add('email', 'Email tidak ditemukan');
        }
        
        return response()->json($validator->errors(), 422);
    }
}
