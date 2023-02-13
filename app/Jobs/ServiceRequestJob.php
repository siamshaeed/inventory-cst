<?php

namespace App\Jobs;

use App\Events\ServiceRequestEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ServiceRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $serviceRequest;
    private $user;

    public $tries = 2;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($serviceRequest, $user)
    {
//        $this->delay = 5;
        $this->serviceRequest = $serviceRequest;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ServiceRequestEvent::dispatch($this->serviceRequest, $this->user);
    }
}
