<?php

namespace FreeElephants\JsonApi\DTO;

use FreeElephants\JsonApi\AbstractTestCase;
use Nyholm\Psr7\ServerRequest;

class DocumentTest extends AbstractTestCase
{

    public function testFromRequest()
    {
        $request = new ServerRequest('POST', '/foo');
        $rawJson = <<<JSON
{
    "data": {
        "id": "123",
        "type": "foo",
        "attributes": {
            "foo": "bar",
            "date": "2012-04-23T18:25:43.511+03:00",
            "nested": {
                "someNestedStructure": {
                    "someKey": "someValue"
                }
            },
            "nullableObjectField": null,
            "nullableScalarField": null,
            "nullableScalarFilledField": "baz"
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
}
JSON;
        $request->getBody()->write($rawJson);

        $fooDTO = FooDocument::fromHttpMessage($request);

        $this->assertInstanceOf(FooResource::class, $fooDTO->data);
        $this->assertInstanceOf(FooAttributes::class, $fooDTO->data->attributes);
        $this->assertSame('foo', $fooDTO->data->type);
        $this->assertSame('bar', $fooDTO->data->attributes->foo);
        $this->assertEquals(new \DateTime('2012-04-23T18:25:43.511+03'), $fooDTO->data->attributes->date);
        $this->assertSame('someValue', $fooDTO->data->attributes->nested->someNestedStructure->someKey);
        $this->assertSame('baz-id', $fooDTO->data->relationships->baz->data->id);
        $this->assertNull($fooDTO->data->attributes->nullableObjectField);
        $this->assertNull($fooDTO->data->attributes->nullableScalarField);
        $this->assertSame('baz', $fooDTO->data->attributes->nullableScalarFilledField);

        $this->assertJsonStringEqualsJsonString($rawJson, json_encode($fooDTO));
    }
}

class FooDocument extends AbstractDocument
{
    public FooResource $data;
}

class FooResource extends AbstractResourceObject
{
    public FooAttributes $attributes;
    public FooRelationships $relationships;
}

class FooAttributes extends AbstractAttributes
{
    public string $foo;
    public \DateTime $date;
    public Nested $nested;
    public ?NullableObjectAttribute $nullableObjectField;
    public ?string $nullableScalarField;
    public ?string $nullableScalarFilledField;
}

class NullableObjectAttribute
{
    public string $someField;
}

class FooRelationships extends AbstractRelationships
{
    public RelationshipToOne $baz;
}

class Nested extends BaseKeyValueStructure
{
    public SomeNestedStructure $someNestedStructure;
}

class SomeNestedStructure extends BaseKeyValueStructure
{
    public string $someKey;
}
