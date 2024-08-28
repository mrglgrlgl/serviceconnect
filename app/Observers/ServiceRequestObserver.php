<?php

namespace App\Observers;

use App\Models\ServiceRequest;
use App\Models\Channel;
use Illuminate\Support\Facades\Log; // Import the Log facade

class ServiceRequestObserver
{
    /**
     * Handle the ServiceRequest "created" event.
     */
    public function created(ServiceRequest $serviceRequest): void
    {
        //
    }

    /**
     * Handle the ServiceRequest "updated" event.
     */
    public function updated(ServiceRequest $serviceRequest)
    {

        Log::info('ServiceRequestObserver updated method triggered', ['service_request_id' => $serviceRequest->id]);

        if ($serviceRequest->isDirty('status')) {
            Log::info('Service request status is dirty', [
                'old_status' => $serviceRequest->getOriginal('status'),
                'new_status' => $serviceRequest->status
            ]);

            if ($serviceRequest->status === 'in_progress') {
                Log::info('Service request status changed to in_progress', ['service_request_id' => $serviceRequest->id]);

                $acceptedBid = $serviceRequest->bids()->where('status', 'accepted')->first();
                if ($acceptedBid) {
                    Channel::create([
                        'seeker_id' => $serviceRequest->user_id,
                        'provider_id' => $serviceRequest->provider_id,
                        'service_request_id' => $serviceRequest->id,
                        'bid_id' => $acceptedBid->id,
                        'status' => 'in_progress',
                    ]);
                    Log::info('Channel record created', ['service_request_id' => $serviceRequest->id]);
                } else {
                    Log::warning('No accepted bid found for service request', ['service_request_id' => $serviceRequest->id]);
                }
            }
        }
    }
    /**
     * Handle the ServiceRequest "deleted" event.
     */
    public function deleted(ServiceRequest $serviceRequest): void
    {
        //
    }

    /**
     * Handle the ServiceRequest "restored" event.
     */
    public function restored(ServiceRequest $serviceRequest): void
    {
        //
    }

    /**
     * Handle the ServiceRequest "force deleted" event.
     */
    public function forceDeleted(ServiceRequest $serviceRequest): void
    {
        //
    }
}
