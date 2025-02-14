<?php
namespace App\Observer;

interface NotificationObserver {
/**
* Sends a notification message.
*
* @param string $message
*/
public function notify(string $message): void;
}
