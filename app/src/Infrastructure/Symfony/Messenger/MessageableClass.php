<?php

namespace App\Infrastructure\Symfony\Messenger;

abstract class MessageableClass
{

    private string $className;

    public function __construct() {
        $this->className = get_class($this);
    }

    public function valuesToArray(): array {
        return array_merge (['className' => $this->className], $this->customValuesToArray());
    }

    public abstract function id(): string;

    public abstract static function createFromArray(array $values): self;

    public abstract function customValuesToArray(): array;
}