<?php

namespace App\Infrastructure\Symfony\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

class NotificationConsumer implements ConsumerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $msg) {
        $this->logger->info('El texto recibido del mensaje es:'.$msg->getBody().'. En el que se definieron estas propiedades:'.implode(', ', $msg->get_properties()));
    }
}