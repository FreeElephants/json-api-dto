<?php

namespace FreeElephants\JsonApiToolkit\DTO\Reflection;

use FreeElephants\JsonApiToolkit\AbstractTestCase;
use FreeElephants\JsonApiToolkit\DTO\AbstractAttributes;
use FreeElephants\JsonApiToolkit\DTO\AbstractRelationships;
use FreeElephants\JsonApiToolkit\DTO\AbstractResourceObject;
use FreeElephants\JsonApiToolkit\DTO\RelationshipToOne;
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
