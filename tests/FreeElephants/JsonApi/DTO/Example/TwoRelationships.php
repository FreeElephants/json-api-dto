<?php

namespace FreeElephants\JsonApi\DTO\Example;

use FreeElephants\JsonApi\DTO\AbstractRelationships;
use FreeElephants\JsonApi\DTO\RelationshipToOne;

class TwoRelationships extends AbstractRelationships
{
    public RelationshipToOne $two;
}
