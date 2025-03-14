<?php
declare(strict_types=1);

namespace FreeElephants\JsonApi\DTO;

use Psr\Http\Message\MessageInterface;

/**
 * @property AbstractResourceObject|AbstractResourceObject[] $data
 */
abstract class TopLevel
{
    /**
     * @param MessageInterface $httpMessage
     * @return static
     */
    public static function fromHttpMessage(MessageInterface $httpMessage): self
    {
        $httpMessage->getBody()->rewind();
        $rawJson = $httpMessage->getBody()->getContents();
        $decodedJson = json_decode($rawJson, true);

        return new static($decodedJson);
    }
}
