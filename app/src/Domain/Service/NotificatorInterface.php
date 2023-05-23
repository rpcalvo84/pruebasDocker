<?php

namespace App\Domain\Service;

interface NotificatorInterface
{
    public function notify(array $msg): void;
}