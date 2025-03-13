<?php

namespace FreeElephants\JsonApiToolkit\DTO;

use Psr\Http\Message\MessageInterface;

/**
 * @property AbstractResourceObject|mixed $data
 */
abstract class AbstractDocument
{
    final public function __construct(array $data)
    {
        $concreteClass = new \ReflectionClass($this);
        $dataProperty = $concreteClass->getProperty('data');
        /** @var \ReflectionNamedType $reflectionType */
        $reflectionType = $dataProperty->getType();
        $dataClassName = $reflectionType->getName();
        $this->data = new $dataClassName($data['data']);
    }

    /**
     * @param MessageInterface $httpMessage
     * @return static
     */
    public static function fromHttpMessage(MessageInterface $httpMessage): self
    {
        $httpMessage->getBody()->rewind();
        $rawJson = $httpMessage->getBody()->getContents();
        $decodedJson = json_decode($rawJson, true);

        return new static($decodedJson);
    }
}
