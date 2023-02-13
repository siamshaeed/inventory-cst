<?php

namespace App\Observers;

use App\Events\NotificationEvent;
use App\Models\ServiceRequest;

class ServiceRequestObserver
{
    /**
     * Handle the ServiceRequest "created" event.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return void
     */
    public function created(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Handle the ServiceRequest "updated" event.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return void
     */
    public function updated(ServiceRequest $serviceRequest)
    {
        //
    }


    /**
     * @param ServiceRequest $serviceRequest
     * @return void
     */
    public function saved(ServiceRequest $serviceRequest)
    {
    }


    public function saving(ServiceRequest $serviceRequest)
    {
        if ($serviceRequest->isDirty('status')) {
            $serviceRequest->workshop_response_time = $serviceRequest->workshop_response_time ?: now();
        }
    }


    /**
     * Handle the ServiceRequest "deleted" event.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return void
     */
    public function deleted(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Handle the ServiceRequest "restored" event.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return void
     */
    public function restored(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Handle the ServiceRequest "force deleted" event.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return void
     */
    public function forceDeleted(ServiceRequest $serviceRequest)
    {
        //
    }
}
