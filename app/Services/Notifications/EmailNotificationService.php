<?php

namespace App\Services\Notifications;
use App\Interfaces\NotificationServiceInterface;
use App\Jobs\MailHandl;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailNotificationService implements NotificationServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function send($email, $message) {

        MailHandl::dispatch($email,$message);
    }
}
