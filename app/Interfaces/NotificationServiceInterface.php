<?php

namespace App\Interfaces;

interface NotificationServiceInterface
{
    public function send($userId, $message);
}
