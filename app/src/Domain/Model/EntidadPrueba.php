<?php

namespace App\Domain\Model;
use DateTime;

class EntidadPrueba
{
    private string $id;
    private DateTime $fecha;

    public function __construct(string $id, DateTime $fecha) {
        $this->id = $id;
        $this->fecha = $fecha;
    }

    public function id(): string {
        return $this->id;
    }

    public function fecha(): DateTime {
        return $this->fecha;
    }
}