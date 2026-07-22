<?php

namespace Modules\User\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Modules\User\Events\PasswordResetNotification;

class SendWelcomeEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(PasswordResetNotification $event): void
    {
        Mail::send('admin.emails.welcome', ['user' => $event->user], function ($message) use ($event) {
            $message->to($event->user->email)->subject('Welcome to Our Platform');
        });
    }
}
