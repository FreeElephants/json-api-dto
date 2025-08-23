<?php

namespace FreeElephants\JsonApi\DTO;

use FreeElephants\JsonApi\AbstractTestCase;

class ResourceObjectTest extends AbstractTestCase
{
    public function testRelationshipTypes()
    {
        $resourceObject = new class([
            'id'            => 'id',
            'type'          => 'type',
            'attributes'    => [
                'foo' => 'bar',
            ],
            'relationships' => [
                'one' => [
                    'data' => [
                        'type' => 'one',
                        'id'   => 'one',
                    ],
                ],
            ],
        ]) extends AbstractResourceObject {
            public Example\Attributes $attributes;
            public Example\OneRelationships $relationships;
        };

        $this->assertInstanceOf(Example\OneRelationships::class, $resourceObject->relationships);
        $this->assertSame('one', $resourceObject->relationships->one->data->type);
    }

    public function testWithNullableId(): void
    {
        $resourceObject = new class([
            'type'          => 'type',
            'attributes'    => [
                'foo' => 'bar',
            ],
            'relationships' => [
                'one' => [
                    'data' => [
                        'type' => 'one',
                        'id'   => 'one',
                    ],
                ],
            ],
        ]) extends AbstractResourceObject {
            public Example\Attributes $attributes;
            public Example\OneRelationships $relationships;
        };

        $this->assertNull($resourceObject->id);
    }
}

class Attributes extends AbstractAttributes
{
    public string $foo;
}
