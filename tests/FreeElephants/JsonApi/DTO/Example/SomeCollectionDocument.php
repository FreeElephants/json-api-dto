<?php
declare(strict_types=1);

namespace FreeElephants\JsonApi\DTO\Example;

use FreeElephants\JsonApi\DTO\AbstractCollection;
use FreeElephants\JsonApi\DTO\AbstractResourceObject;

class SomeCollectionDocument extends AbstractCollection
{
    public function getDataItemClassName(): string
    {
        return DataItemResourceObject::class;
    }
}

class DataItemResourceObject extends AbstractResourceObject
{
}
