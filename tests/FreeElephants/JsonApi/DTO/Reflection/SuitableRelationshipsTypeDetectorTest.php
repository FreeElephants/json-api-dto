<?php

namespace FreeElephants\JsonApi\DTO\Reflection;

use FreeElephants\JsonApi\AbstractTestCase;
use FreeElephants\JsonApi\DTO\AbstractAttributes;
use FreeElephants\JsonApi\DTO\AbstractRelationships;
use FreeElephants\JsonApi\DTO\AbstractResourceObject;
use FreeElephants\JsonApi\DTO\RelationshipToOne;
use ReflectionProperty;

class SuitableRelationshipsTypeDetectorTest extends AbstractTestCase
{

    public function testDetect()
    {
        $detector = new SuitableRelationshipsTypeDetector();
        $relationshipsProperty = new ReflectionProperty(ResourceWithUnionTypedRelationships::class, 'relationships');
        $relationshipsPropertyUnionType = $relationshipsProperty->getType();
        $detectedOne = $detector->detect($relationshipsPropertyUnionType, [
            'fuzz' => [
                'data' => [
                    'id'   => 'fuzz',
                    'type' => 'fuzz',
                ],
            ],
        ]);
        $this->assertSame(FuzzRelationships::class, $detectedOne);

        $detectedTwo = $detector->detect($relationshipsPropertyUnionType, [
            'bar' => [
                'data' => [
                    'id'   => 'bazz',
                    'type' => 'bazz',
                ],
            ],
        ]);
        $this->assertSame(BarRelationships::class, $detectedTwo);
    }
}

class ResourceWithUnionTypedRelationships extends AbstractResourceObject
{
    public BazzAttributes $attributes;
    public FuzzRelationships|BarRelationships $relationships;
}

class BazzAttributes extends AbstractAttributes
{
    public string $bazz;
}

class FuzzRelationships extends AbstractRelationships
{
    public RelationshipToOne $fuzz;
}

class BarRelationships extends AbstractRelationships
{
    public RelationshipToOne $bar;
}
