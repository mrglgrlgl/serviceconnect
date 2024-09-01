<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PhilIDRejected extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    // Only use the database channel
    public function via($notifiable)
    {
        return ['database'];
    }

    // The data to store in the database
    public function toArray($notifiable)
    {
        return [
            'message' => 'Your PhilID verification has been rejected. Please ensure that the provided information matches the PhilID document.',
            'action_url' => url('/philid'),
        ];
    }
}
