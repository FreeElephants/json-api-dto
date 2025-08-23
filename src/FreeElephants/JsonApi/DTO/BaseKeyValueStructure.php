<?php

namespace FreeElephants\JsonApi\DTO;

class BaseKeyValueStructure
{
    public function __construct(array $attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->assignFieldValue($name, $value);
        }
    }

    protected function assignFieldValue(string $name, $value): self
    {
        $concreteClass = new \ReflectionClass($this);
        $property = $concreteClass->getProperty($name);
        if ($property->hasType()) {
            $propertyType = $property->getType();
            if ($propertyType instanceof \ReflectionNamedType && !$propertyType->isBuiltin()) {
                if($propertyType->allowsNull() && is_null($value)) {
                    $value = null;
                } else {
                    $propertyClassName = $propertyType->getName();
                    if($propertyClassName === \DateTimeInterface::class) {
                        $value = new \DateTime($value);
                    } else {
                        $value = new $propertyClassName($value);
                    }
                }
            }
        }

        $this->$name = $value;

        return $this;
    }
}
