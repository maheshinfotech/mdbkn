<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\TwilioMessage;

class CheckoutNotification extends Notification
{
    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking->mobile_number;
       //dd($this);
    }

    public function toTwilio($notifiable)
    {
        $guestName = $this->booking->guest_name;
        $mobileNumber = $this->booking->user->mobile_number;
       //  dd($mobileNumber);
        return (new TwilioMessage())
            ->content("Hello {$guestName}, your checkout details have been saved. Thank you for staying with us!")
            ->to($mobileNumber);
    }

    public function via($notifiable)
    {
        return ['twilio'];
    }
}
