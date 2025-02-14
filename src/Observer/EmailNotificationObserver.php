<?php

namespace App\Observer;

class EmailNotificationObserver implements NotificationObserver
{
    public function notify(string $message): void {
        var_dump("📧 Email envoyé: " . $message);
        echo "Email sent: $message" . PHP_EOL;
    }
}