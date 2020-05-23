<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    public function resetForm(Request $request, $token = null)
    {
        // ACTION FRONTEND REQUIRED
        return response()->json([
            'email' => $request->input('email'),
            'token' => $token
        ], 200);
    }

    /**
     * Reset password
     * 
     * @param \Illuminate\Http\Request ResetPasswordRequest
     * @return \Illuminate\Http\Response Reset Status
     */
    public function reset(ResetPasswordRequest $request) 
    {
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return response()->json([
                'status' => true,
                'data'   => 'Reset password berhasil'
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'data'   => 'Reset password gagal'
            ], 200);
        }
    }
}
