<?php

namespace App\Listeners;

use App\Events\RessetPassWordSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;


class SendMailRessetPassWordNotication implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RessetPassWordSuccess $event): void
    {
        $user = $event->user;
        $email = new ForgotPassword($user);
        $user = Mail::to($user->email)->send($email);
    }
}
