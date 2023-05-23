<?php

namespace App\Infrastructure\Domain\Model;

use App\Infrastructure\Symfony\Messenger\MessageableClass;
use App\Domain\Model\EntidadPrueba;
use \DateTime;

class EntidadPruebaMessageable extends MessageableClass
{
    private EntidadPrueba $entidadPrueba;

    public function __construct(EntidadPrueba $entidadPrueba) {
        parent::__construct();
        $this->entidadPrueba = $entidadPrueba;
    }

    public function id(): string {
        return $this->entidadPrueba->id();
    }

    public function fecha(): DateTime {
        return $this->entidadPrueba->fecha();
    }

    public function customValuesToArray(): array {
        return [
            'id' => $this->entidadPrueba->id(),
            'fecha' => $this->entidadPrueba->fecha(),
        ];
    }

    public static function createFromArray(array $values): self {
        if (
            !isset($values['id'])
            || !isset($values['fecha'])
            || !isset($values['fecha']['date'])
        ) {
            throw Exception();
        }

        return new self(
            new EntidadPrueba(
                $values['id'],
                new DateTime($values['fecha']['date'])
            )
        );
    }
}