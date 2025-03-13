<?php

namespace FreeElephants\JsonApiToolkit\DTO;

class BaseKeyValueStructure
{
    public function __construct(array $attributes)
    {
        $concreteClass = new \ReflectionClass($this);
        foreach ($attributes as $name => $value) {
            $property = $concreteClass->getProperty($name);
            if ($property->hasType()) {
                $propertyType = $property->getType();
                if ($propertyType instanceof \ReflectionNamedType && !$propertyType->isBuiltin()) {
                    $propertyClassName = $propertyType->getName();
                    $value = new $propertyClassName($value);
                }
            }
            $this->{$name} = $value;
        }
    }
}
