<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;

class EnsureEmailApiIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail())) {
            // return $request->expectsJson()
            //         ? abort(403, 'Your email address is not verified.')
            //         : Redirect::route($redirectToRoute ?: 'verification.notice');
            $response = [
                'status'=> false,
                'data'  => 'Email anda belum terverifikasi'
            ];
            return response()->json($response, 403);
        }

        return $next($request);
    }
}
