<?php

namespace FreeElephants\JsonApiToolkit\DTO\Example;

use FreeElephants\JsonApiToolkit\DTO\AbstractRelationships;
use FreeElephants\JsonApiToolkit\DTO\RelationshipToOne;

class OneRelationships extends AbstractRelationships
{
    public RelationshipToOne $one;
}
