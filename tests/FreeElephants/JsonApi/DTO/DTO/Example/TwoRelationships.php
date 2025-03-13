<?php

namespace FreeElephants\JsonApiToolkit\DTO\Example;

use FreeElephants\JsonApiToolkit\DTO\AbstractRelationships;
use FreeElephants\JsonApiToolkit\DTO\RelationshipToOne;

class TwoRelationships extends AbstractRelationships
{
    public RelationshipToOne $two;
}
