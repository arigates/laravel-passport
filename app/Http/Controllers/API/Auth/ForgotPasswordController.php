<?php

namespace App\Http\Controllers\API\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Forgot Password
     * 
     * @param \Illuminate\Http\Request UserRegisterRequest
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $email      = $request->input('email');
        $user       = User::where('email', $email)->first();
        $response   = [];
        
        if ($user) {
            $response = $this->broker()->sendResetLink($request->only('email'));
            if ($response == Password::RESET_LINK_SENT) {
                $response = [
                    'status'=> true,
                    'data'  => 'Email reset password terkirim'
                ];
            } else {
                $response = [
                    'status'=> false,
                    'data'  => 'Gagal mengirim email'
                ];
            }
        } else {
            $response = [
                'status'=> false,
                'data'  => 'Akun tidak ditemukan'
            ];
        }

        return response()->json($response, 200);
    }
}
