<?php

namespace App\Infrastructure\Domain\Service;

use App\Domain\Service\NotificatorInterface;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

class RabbitMqNotificator implements NotificatorInterface
{
    private ProducerInterface $rabbitMqService;

    public function __construct(ProducerInterface $rabbitMqService) {
        $this->rabbitMqService = $rabbitMqService;
    }

    public function notify(array $msg = array ('user_id' => 1234, 'body_message' => 'hola cara cola!')): void
    {
        $this->rabbitMqService->publish(serialize($msg));
    }
}