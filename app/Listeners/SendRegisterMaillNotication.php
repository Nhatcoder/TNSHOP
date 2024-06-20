<?php

namespace App\Listeners;

use App\Events\RegisterMaillSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;

class SendRegisterMaillNotication implements ShouldQueue
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
    public function handle(RegisterMaillSuccess $event): void
    {
        $user = $event->user;
        $email = new RegisterMail($user);
        $user = Mail::to($user->email)->send($email);
        // Mail::to('TNShop@example.com')->send($user);
    }
}
