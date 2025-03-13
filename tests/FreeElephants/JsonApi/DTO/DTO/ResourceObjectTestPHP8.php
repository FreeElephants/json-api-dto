<?php

namespace FreeElephants\JsonApiToolkit\DTO;

use FreeElephants\JsonApiToolkit\AbstractTestCase;

class ResourceObjectTestPHP8 extends AbstractTestCase
{
    public function testUnionTypes()
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
        ]) extends AbstractResourceObject{
            public Example\Attributes $attributes;
            public Example\OneRelationships|Example\TwoRelationships $relationships;
        };

        $this->assertSame('one', $resourceObject->relationships->one->data->type);
    }
}

