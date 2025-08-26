<?php
declare(strict_types=1);

namespace FreeElephants\JsonApi\DTO\Field;

class DateTimeFieldValue extends \DateTime implements \JsonSerializable
{
    public const DEFAULT_JSONAPI_DATE_FORMAT = 'Y-m-d\TH:i:s.vp';
    private static string $format = self::DEFAULT_JSONAPI_DATE_FORMAT;

    public static function setFormat(string $format)
    {
        self::$format = $format;
    }

    public function jsonSerialize(): string
    {
        return $this->format(self::$format);
    }
}
