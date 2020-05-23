<?php

namespace App\Notifications;

use Carbon\Carbon as Carbon;
use Illuminate\Auth\Notifications\ResetPassword;

class ResetPasswordRequestNotification extends ResetPassword
{
  public function __construct($token)
  {
    $this->token = $token;
    $this->createUrlUsing([__NAMESPACE__ .'\ResetPasswordRequestNotification', 'forgotPasswordUrl']);
  }

  /**
   * URL Link Reset Password
   * 
   * @param mixed $notifiable
   * @param string $token
   * @return string
   */
  public static function forgotPasswordUrl($notifiable, $token)
  {
    $url = url(route('forgotpassword.reset', [
        'token' => $token,
        'email' => $notifiable->getEmailForPasswordReset(),
    ], false));

    return $url;
  }
}

?>