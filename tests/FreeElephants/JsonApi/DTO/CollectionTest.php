<?php
declare(strict_types=1);

namespace FreeElephants\JsonApi\DTO;

use FreeElephants\JsonApi\AbstractTestCase;
use FreeElephants\JsonApi\DTO\Example\SomeCollectionDocument;
use Nyholm\Psr7\ServerRequest;

class CollectionTest extends AbstractTestCase
{
    public function testCollectionFromHttpMessage(): void
    {
        $request = new ServerRequest('GET', '/foos');
        $request->getBody()->write(<<<JSON
{
    "data": [
          {
            "id": "123",
            "type": "foo",
            "attributes": {
                "foo": "bar",
                "date": "2012-04-23T18:25:43.511Z",
                "nested": {
                    "someNestedStructure": {
                        "someKey": "someValue"
                    }
                }
            },
            "relationships": {
                "baz": {
                    "data": {
                        "type": "bazs",
                        "id": "baz-id"
                    }
                }
            }
        }
    ]
}
JSON
        );

        $collectionDto = SomeCollectionDocument::fromHttpMessage($request);

        $this->assertCount(1, $collectionDto->data);
        $this->assertSame('123', $collectionDto->data[0]->id);
        $this->assertSame('foo', $collectionDto->data[0]->type);
    }
}
