<?php

namespace FreeElephants\JsonApiToolkit\DTO;

class ResourceIdentifierObject
{
    public string $id;
    public string $type;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->type = $data['type'];
    }
}
