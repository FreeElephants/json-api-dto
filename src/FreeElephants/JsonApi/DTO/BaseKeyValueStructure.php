<?php

namespace FreeElephants\JsonApi\DTO;

use FreeElephants\JsonApi\DTO\Exception\UnexpectedValueException;
use FreeElephants\JsonApi\DTO\Field\DateTimeFieldValue;

class BaseKeyValueStructure
{
    private static bool $ignoreUnexpectedAttributes = false;

    public static function ignoreUnexpectedAttributes(bool $ignore = true): void
    {
        static::$ignoreUnexpectedAttributes = $ignore;
    }

    public function __construct(array $attributes)
    {
        $concreteClass = new \ReflectionClass($this);
        foreach ($attributes as $name => $value) {
            $this->assignFieldValue($concreteClass, $name, $value);
        }
    }

    protected function assignFieldValue(\ReflectionClass $class, string $name, $value): self
    {
        if ($class->hasProperty($name)) {
            $property = $class->getProperty($name);
            if ($property->hasType()) {
                $propertyType = $property->getType();
                if ($propertyType instanceof \ReflectionNamedType && !$propertyType->isBuiltin()) {
                    if ($propertyType->allowsNull() && is_null($value)) {
                        $value = null;
                    } else {
                        $propertyClassName = $propertyType->getName();
                        if (in_array($propertyClassName, [\DateTimeInterface::class, \DateTime::class])) {
                            $value = new DateTimeFieldValue($value);
                        } else {
                            $value = new $propertyClassName($value);
                        }
                    }
                }
            }

            $this->$name = $value;
        } else {
            if (!self::$ignoreUnexpectedAttributes) {
                throw new UnexpectedValueException(sprintf('Provided field with name `%s` does not exists in this type (%s)', $name, $class));
            }
        }

        return $this;
    }
}
