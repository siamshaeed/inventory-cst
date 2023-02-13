<?php

namespace App\Http\Controllers;

use App\Events\RealTimeNotificationEvent;
use App\Events\WorkshopEvent;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{


    public function verifyChannel(Request $request)
    {
        dd($request);
    }


}
