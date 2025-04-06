<?php

namespace FreeElephants\JsonApi\DTO\Reflection;

use FreeElephants\JsonApi\AbstractTestCase;
use FreeElephants\JsonApi\DTO\AbstractResourceObject;
use FreeElephants\JsonApi\DTO\Example;
use FreeElephants\JsonApi\DTO\Example\AttributesExt;

class ResourceObjectTestPHP8 extends AbstractTestCase
{
    public function testUnionTypes()
    {
        $resourceObject = new class([
            'id'            => 'id',
            'type'          => 'type',
            'attributes'    => [
                'foo' => 'bar',
                'baz' => 1,
            ],
            'relationships' => [
                'one' => [
                    'data' => [
                        'type' => 'one',
                        'id'   => 'one',
                    ],
                ],
            ],
        ]) extends AbstractResourceObject{
            public Example\AttributesExt|Example\Attributes $attributes;
            public Example\OneRelationships|Example\TwoRelationships $relationships;
        };

        $this->assertSame('one', $resourceObject->relationships->one->data->type);
        $this->assertSame('bar', $resourceObject->attributes->foo);
        $this->assertSame(1, $resourceObject->attributes->baz);
        $this->assertInstanceOf(AttributesExt::class, $resourceObject->attributes);
    }
}

