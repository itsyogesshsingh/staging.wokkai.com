<?php

namespace Modules\User\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Modules\User\Events\UserRegistered;

class SendPasswordResetEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $url = url('/set-password?token=' . $event->token . '&email=' . $event->user->email);

        Mail::send('admin.emails.set-password', [
            'user' => $event->user,
            'url' => $url
        ], function ($message) use ($event) {
            $message->to($event->user->email)->subject('Set Your Password & Activate Account');
        });
    }
}
