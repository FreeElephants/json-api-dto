<?php

namespace FreeElephants\JsonApiToolkit\DTO\Reflection;

class SuitableRelationshipsTypeDetector
{

    public function detect(\ReflectionUnionType $propertyUnionType, array $data): ?string
    {
        foreach ($propertyUnionType->getTypes() as $type) {
            $candidateType = $type->getName();
            $candidateClass = new \ReflectionClass($candidateType);
            $isCandidate = false;
            foreach ($data as $propertyName => $propertyData) {
                if (!$candidateClass->hasProperty($propertyName)) {
                    break;
                }
                $isCandidate = true;
            }
            if ($isCandidate) {
                break;
            }
        }

        return $candidateType;
    }
}
