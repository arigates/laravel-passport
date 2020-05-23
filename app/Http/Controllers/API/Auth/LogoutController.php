<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * User Logout
     * Request $request
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response logout status
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = [
            'status'=> true,
            'data'  => 'Logout berhasil'    
        ];
        return response()->json($response, 200);
    }
}
