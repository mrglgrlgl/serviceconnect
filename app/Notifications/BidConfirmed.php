<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Bid;
use App\Models\ServiceRequest;

class BidConfirmed extends Notification
{
    use Queueable;

    protected $bid;
    protected $serviceRequest;

    public function __construct(Bid $bid, ServiceRequest $serviceRequest)
    {
        $this->bid = $bid;
        $this->serviceRequest = $serviceRequest;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Your bid has been confirmed for the service request: ' . $this->serviceRequest->title,
            'bid_id' => $this->bid->id,
            'service_request_id' => $this->serviceRequest->id,
        ];
    }
}
