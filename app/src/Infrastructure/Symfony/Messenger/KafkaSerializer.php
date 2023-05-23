<?php

namespace App\Infrastructure\Symfony\Messenger;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use App\Infrastructure\Symfony\Messenger\MessageableClass;
use \Exception;

final class KafkaSerializer implements SerializerInterface
{
    public function decode (array $encodedEnvelope): Envelope {
        $this->checkEnvelopeContent($encodedEnvelope);

        $someModelAsArray = json_decode($encodedEnvelope['body'], true);

        /** @var MessageableClass */
        $model = $someModelAsArray['className']::createFromArray($someModelAsArray);

        return new Envelope($model);
    }

    public function encode (Envelope $envelope): array {
        /** @var MessageableClass */
        $event = $envelope->getMessage();

        return [
            'key' => $event->id(),
            'headers' => [],
            'body' => json_encode($event->valuesToArray()),
        ];
    }

    private function checkEnvelopeContent(array $encodedEnvelope) {

        $someModelAsArray = json_decode($encodedEnvelope['body'], true);

        if (
            !isset($encodedEnvelope['body'])
            || is_null($someModelAsArray)
            || !isset($someModelAsArray['className'])
            ) {
            throw new Exception('El formato del mensaje Kafka no es el esperado');
        }
    }
}
