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
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->locale = (string) $data['locale'];
        $this->value  = (string) $data['value'];
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
