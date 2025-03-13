<?php

namespace FreeElephants\JsonApiToolkit\DTO;

use FreeElephants\JsonApiToolkit\DTO\Reflection\SuitableRelationshipsTypeDetector;

/**
 * @property AbstractAttributes $attributes
 * @property AbstractRelationships $relationships
 */
class AbstractResourceObject
{
    public string $id;
    public string $type;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->type = $data['type'];

        $concreteClass = new \ReflectionClass($this);

        if (property_exists($this, 'attributes')) {
            $attributesProperty = $concreteClass->getProperty('attributes');
            $attributesClass = $attributesProperty->getType()->getName();
            $this->attributes = new $attributesClass($data['attributes']);
        }

        if (property_exists($this, 'relationships')) {
            $relationshipsData = $data['relationships'];
            $concreteClass = new \ReflectionClass($this);
            $relationshipsProperty = $concreteClass->getProperty('relationships');
            $reflectionType = $relationshipsProperty->getType();

            // handle php 8 union types
            if ($reflectionType instanceof \ReflectionUnionType) {
                $relationshipsClass = (new SuitableRelationshipsTypeDetector())->detect($reflectionType, $relationshipsData);
            } else {
                $relationshipsClass = $reflectionType->getName();
            }

            $relationshipsDto = new $relationshipsClass($relationshipsData);
            $this->relationships = $relationshipsDto;
        }
    }
}
