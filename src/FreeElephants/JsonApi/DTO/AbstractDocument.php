<?php

namespace FreeElephants\JsonApi\DTO;

use Psr\Http\Message\MessageInterface;

/**
 * @property AbstractResourceObject|mixed $data
 */
abstract class AbstractDocument extends TopLevel
{
    final public function __construct(array $payload)
    {
        $concreteClass = new \ReflectionClass($this);
        $dataProperty = $concreteClass->getProperty('data');
        /** @var \ReflectionNamedType $reflectionType */
        $reflectionType = $dataProperty->getType();
        $dataClassName = $reflectionType->getName();
        if ($dataClassName !== 'array') {
            $data = new $dataClassName($payload['data']);
        } else {
            throw new \UnexpectedValueException('`data` property must be typed, for array of resources use AbstractCollection instead ' . self::class);
        }
        $this->data = $data;
    }
}
