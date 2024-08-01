<?php

namespace App\Notifications;
use App\Models\Bid;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BidPlacedNotification extends Notification
{
    use Queueable;

    private $serviceRequest;
    private $provider;

    public function __construct($serviceRequest, $provider)
    {
        $this->serviceRequest = $serviceRequest;
        $this->provider = $provider;
    }

    public function via($notifiable)
    {
        return ['database']; // 'mail' can be added if email notifications are desired
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A provider has placed a bid on your service request.',
            'service_request_id' => $this->serviceRequest->id,
            'provider_name' => $this->provider->name,
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'A new bid has been placed on your service request: ' . $this->serviceRequest->title,
            'bid_id' => $this->bid->id,
            'service_request_id' => $this->serviceRequest->id,
            'provider_name' => $this->bid->provider->name,  // Assuming there's a relationship to get the provider's name
        ];
    }
}

