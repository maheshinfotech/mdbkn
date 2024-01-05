<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\TwilioMessage;

namespace App\Notifications;

use Illuminate\Notifications\Messages\TwilioMessage;
use Illuminate\Notifications\Notification;


class CheckoutNotification extends Notification
{
    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking->id;
      //  dd($this->booking);
    }

    public function toTwilio($notifiable)
    {
        
        $guestName = $this->booking->guest_name;
        return [
            'content' => "Hello {$guestName}, your checkout details have been saved. Thank you for staying with us!",
        ];
    }
}
