<?php

namespace FreeElephants\JsonApiToolkit\DTO;

abstract class AbstractRelationships
{
    public function __construct(array $data)
    {
        foreach ($data as $relationshipName => $relationshipsData) {
            $this->{$relationshipName} = new RelationshipToOne($relationshipsData);
        }
    }
}
