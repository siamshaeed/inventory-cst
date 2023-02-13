<?php

namespace App\Broadcasting;

use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class BroadcastChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user, $serviceRequest)
    {
        Log::info('info-channel', [$user, $serviceRequest]);
        return true;
    }
}
