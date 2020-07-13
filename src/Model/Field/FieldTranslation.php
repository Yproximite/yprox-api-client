<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\Field;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class FieldTranslation
 */
class FieldTranslation implements ModelInterface
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $value;

    /**
     * FieldTranslation constructor.
     */
    public function __construct(array $data)
    {
        $this->locale = (string) $data['locale'];
        $this->value  = (string) $data['value'];
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
