<?php
declare(strict_types=1);

namespace FreeElephants\JsonApi\DTO;

use Psr\Http\Message\MessageInterface;

/**
 * @property AbstractResourceObject|AbstractResourceObject[] $data
 */
abstract class TopLevel
{
    public static function fromHttpMessage(MessageInterface $httpMessage, bool $ignoreUnexpectedAttributes = false): self
    {
        $httpMessage->getBody()->rewind();
        $rawJson = $httpMessage->getBody()->getContents();
        $decodedJson = json_decode($rawJson, true);

        if($ignoreUnexpectedAttributes) {
            BaseKeyValueStructure::ignoreUnexpectedAttributes($ignoreUnexpectedAttributes);
        }
        $dto = new static($decodedJson);

        BaseKeyValueStructure::ignoreUnexpectedAttributes(false);

        return $dto;
    }
}
