<?php

namespace App\Services;

use App\Observer\NotificationObserver;

class NotificationManager
{
    /**
     * @var NotificationObserver[]
     */
    private array $observers = [];

    /**
     * Adds an observer to the list.
     *
     * @param NotificationObserver $observer
     */
    public function addObserver(NotificationObserver $observer): void {
        $this->observers[] = $observer;
    }

    /**
     * Removes an observer from the list.
     *
     * @param NotificationObserver $observer
     */
    public function removeObserver(NotificationObserver $observer): void {
        $this->observers = array_filter(
            $this->observers,
            static fn($obs) => $obs !== $observer
        );
    }

    /**
     * Notifies all observers with the given message.
     *
     * @param string $message
     */
    public function notifyAll(string $message): void {
        var_dump("🔔 NotificationManager: Envoi de la notification...");

        foreach ($this->observers as $observer) {
            var_dump("📨 Envoi de la notification à un observer...");
            $observer->notify($message);
        }
    }
}