<?php

namespace App\Application;

use App\Domain\Service\NotificatorInterface;

class SendNotification{

    private NotificatorInterface $notificator;

    public function __construct(NotificatorInterface $notificator){
        $this->notificator = $notificator;
    }

    public function notify(): void
    {
        $this->notificator->notify();
    }
}