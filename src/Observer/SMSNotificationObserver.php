<?php

namespace App\Observer;

class SMSNotificationObserver implements NotificationObserver
{
    public function notify(string $message): void {
        var_dump("📧 SMS envoyé: " . $message);
        echo "SMS sent: $message" . PHP_EOL;
    }
}