<?php

namespace App\Infrastructure\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
//use Psr\Log\LoggerInterface;

use App\Application\SendNotification;

use Symfony\Component\Messenger\MessageBusInterface;
use App\Infrastructure\Domain\Model\EntidadPruebaMessageable;
use DateTime;
use App\Domain\Model\EntidadPrueba;

class DashboardController extends AbstractController
{

    /**
     * @Route("/", name="default")
     *
     * @return Response
     */
    public function default(
        SendNotification $notificationSender,
        MessageBusInterface $bus
    ): Response {

        // enviar notificacion a RabbitMq
        $notificationSender->notify();

        //enviar notificacion a messenger configurado con Kafka
        $id = "1";
        $fecha = new DateTime();
        $bus->dispatch(new EntidadPruebaMessageable(new EntidadPrueba($id, $fecha)));

        return $this->render('Dashboard/default.html.twig');
    }

}