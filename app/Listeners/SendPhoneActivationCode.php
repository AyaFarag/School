<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPhoneActivationCode
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user  = $event -> user;
        $phone = $event -> phone;

        $confirmation_code = join("", array_map(function($value) { return mt_rand(0, 9); }, range(1, 4)));

        $phone -> confirmation_code = $confirmation_code;
        $phone -> save();

        //send SMS
    }
}
