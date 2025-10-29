<?php

namespace FreeElephants\JsonApi\DTO;

use FreeElephants\JsonApi\DTO\Exception\UnexpectedValueException;

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

        /**
         * In cases like:
         * `public array|Example\ResourceObjectExt|Example\ResourceObject $data;`
         * ReflectionUnionType::getTypes() return types in next orders:
         * - Example\ResourceObjectExt
         * - Example\ResourceObject
         * - array
         *
         * This exception is [can] not covered with test. But this behavior not documented at https://www.php.net/manual/en/reflectionuniontype.gettypes.php
         */
        if ($dataClassName !== 'array') {
            $data = new $dataClassName($payload['data']);
        } else {
            throw new UnexpectedValueException('`data` property must be typed, for array of resources use AbstractCollection instead ' . self::class);
        }
        $this->data = $data;
    }
}
