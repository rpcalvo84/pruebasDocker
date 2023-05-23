<?php

namespace App\Infrastructure\Symfony\Messenger;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Psr\Log\LoggerInterface;
use App\Infrastructure\Domain\Model\EntidadPruebaMessageable;

class KafkaNotificationHandler implements MessageHandlerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    // SE PUEDE CREAR UN HANDLER GENÉRICO, PARA CUALQUIER MENSAJE:
    /*
    public function __invoke(MessageableClass $message)
    {
        if ($message instanceof EntidadPruebaMessageable) {
            $this->logger->info('Hola! El mensaje tenía id='.$message->id().' y fecha='.$message->fecha()->format('Y-m-d H:i:s'));
        } else {
            $this->logger->info('Clase de mensaje no identificada');
        }
        
        
    }
*/

    // O SE PUEDE CREAR UN HANDLER POR CADA TIPO DE MENSAJE:
    public function __invoke(EntidadPruebaMessageable $message)
    {
        $this->logger->info('Hola! El mensaje tenía id='.$message->id().' y fecha='.$message->fecha()->format('Y-m-d H:i:s'));
    }
}