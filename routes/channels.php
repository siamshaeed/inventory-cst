<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/



//Broadcast::channel('service-request.{serviceRequest}', \App\Broadcasting\BroadcastChannel::class);


Broadcast::channel('workshop.{id}', function ($user, $id) {
    if ($user->workshop) {
        return $user->workshop->id == $id;
    }
});


Broadcast::channel('user.{id}', function ($user, $id) {
    if ($user) {
        return $user->id == $id;
    }
});
