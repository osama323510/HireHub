<?php

namespace App\Services\Notifications;
use App\Interfaces\NotificationServiceInterface;
use Illuminate\Support\Facades\Log;
class EmailNotificationService implements NotificationServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function send($email, $message) {
        Log::info("Sending Email to User $email: $message");
    }
}
