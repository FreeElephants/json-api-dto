<?php

namespace FreeElephants\JsonApi\DTO\Example;

use FreeElephants\JsonApi\DTO\AbstractRelationships;
use FreeElephants\JsonApi\DTO\RelationshipToOne;

/**
 * @internal
 */
class OneRelationships extends AbstractRelationships
{
    public RelationshipToOne $one;
}
