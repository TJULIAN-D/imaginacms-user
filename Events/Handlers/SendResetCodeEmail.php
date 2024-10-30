<?php

namespace Modules\User\Events\Handlers;

use Illuminate\Contracts\Mail\Mailer;
use Modules\User\Emails\ResetPasswordEmail;
use Modules\User\Events\UserHasBegunResetProcess;

class SendResetCodeEmail
{
  /**
   * @var Mailer
   */
  private $mailer;

  public function __construct(Mailer $mailer)
  {
    $this->mailer = $mailer;
    $this->notification = app("Modules\Notification\Services\Inotification");
  }

  public function handle(UserHasBegunResetProcess $event)
  {
    //$this->mailer->to($event->user->email)->send(new ResetPasswordEmail($event->user, $event->code));
    $this->notification->to([
      'email' => $event->user->email
    ])->push(
      [
        'title' => trans('user::messages.reset password'),
        'view' => 'user::emails.reminder',
        'setting' => ['saveInDatabase' => 1],
        'user' => $event->user,
        'code' => $event->code,
      ]
    );
  }
}
