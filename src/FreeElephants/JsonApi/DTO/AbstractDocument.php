<?php

namespace FreeElephants\JsonApi\DTO;

/**
 * @property AbstractResourceObject|mixed $data
 */
abstract class AbstractDocument extends TopLevel
{
    final public function __construct(array $payload)
    {
        $concreteClass = new \ReflectionClass($this);
        $dataProperty = $concreteClass->getProperty('data');

        $reflectionType = $dataProperty->getType();
        if ($reflectionType instanceof \ReflectionNamedType) {
            $dataClassName = $reflectionType->getName();
        } else {
            /** @var \ReflectionUnionType $reflectionType */
            $dataClassName = $reflectionType->getTypes()[0]->getName();
        }
        if ($dataClassName !== 'array') {
            $data = new $dataClassName($payload['data']);
        } else {
            throw new \UnexpectedValueException('`data` property must be typed, for array of resources use AbstractCollection instead ' . self::class);
        }
        $this->data = $data;
    }
}
