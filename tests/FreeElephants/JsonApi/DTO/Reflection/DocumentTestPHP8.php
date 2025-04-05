<?php
declare(strict_types=1);

namespace FreeElephants\JsonApi\DTO\Reflection;

use FreeElephants\JsonApi\AbstractTestCase;
use FreeElephants\JsonApi\DTO\AbstractDocument;
use FreeElephants\JsonApi\DTO\Example;

class DocumentTestPHP8 extends AbstractTestCase
{
    public function testUnionTypes(): void
    {
        $document = new class([
            'data' => [
                'id' => '1',
                'type' => 'foos',
            ],
        ]) extends AbstractDocument {
            public Example\ResourceObjectExt|Example\ResourceObject $data;
        };

        $this->assertInstanceOf(Example\ResourceObjectExt::class, $document->data);
    }
}
