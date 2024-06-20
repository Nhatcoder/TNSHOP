<?php

namespace App\Listeners;

use App\Events\OrderUserSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderUser;

class SendMailOrderUser implements ShouldQueue
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
    public function handle(OrderUserSuccess $event): void
    {
        $user = $event->user;
        $email = new OrderUser($user);
        $user = Mail::to($user->email)->send($email);
    }
}
