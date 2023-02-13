<?php

namespace App\Jobs;

use App\Events\ServiceResponseEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ServiceResponseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $serviceRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($serviceRequest)
    {
        $this->serviceRequest = $serviceRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ServiceResponseEvent::dispatch($this->serviceRequest);
    }
}
