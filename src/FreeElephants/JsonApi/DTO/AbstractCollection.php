<?php
declare(strict_types=1);

namespace FreeElephants\JsonApi\DTO;

abstract class AbstractCollection extends TopLevel
{
    public array $data = [];

    final public function __construct(array $payload = [])
    {
        foreach ($payload['data'] as $item) {
            $dataItemClassName = $this->getDataItemClassName();
            $this->data[] = new $dataItemClassName($item);
        }
    }

    abstract public function getDataItemClassName(): string;
}
