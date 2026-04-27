<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class MailHandl implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $message;
    public $gmail;
    public function __construct(string $gmail,string $message)
    {
        $this->message=$message;
        $this->gmail=$gmail;
    }

    /**
     * Execute the job.
     */
    public function handle() : void
    {
        Mail::to($this->gmail)->send(new TestEmail($this->message));
    }
}
