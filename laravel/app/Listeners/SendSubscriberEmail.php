<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
use Mail;

class SendSubscriberEmail
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
    public function handle(UserSubscribed $event): void
    {
        //send email to subscribed user
        Mail::raw('Thank you for subscribing', function($message) use ($event){
            $message->to($event->user->email);
            $message->subject('Thank you!');
        });
;    }
}
