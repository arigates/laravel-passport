<?php

namespace App\Http\Controllers\API\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon as Carbon;
use Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class RegisterVerificationController extends Controller
{
    use VerifiesEmails;

    /**
    * Mark the authenticated user’s email address as verified.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function verify(Request $request)
    {
        $userID     = $request['id'];
        $user       = User::findOrFail($userID);
        $response   = [];
        
        if ($user->email_verified_at) {
            $response = [
                'status'=> false,
                'data'  => 'Email sudah pernah dikonfirmasi' 
            ];
        } else {
            $user->email_verified_at = Carbon::now();
            $user->save();
            $response = [
                'status'=> true,
                'data'  => 'Verifikasi email berhasil' 
            ];
        }

        return response()->json($response, 200);
    }

    /**
    * Resend the email verification notification.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function resend(Request $request)
    {
        $response = [];
        if ($request->user()->hasVerifiedEmail()) {
            $response = [
                'status'=> true,
                'data'  => 'Pengguna sudah terverifikasi' 
            ];
        } else {
            $request->user()->sendEmailVerificationNotification();
            $response = [
                'status'=> true,
                'data'  => 'Email verifikasi sudah terkirim, cek email Anda' 
            ];
        }

        return response()->json($response, 200);
    }
}
