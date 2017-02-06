<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Location;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class LocationTranslation
 */
class LocationTranslation implements ModelInterface
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string|null
     */
    private $openingHours;

    /**
     * LocationTranslation constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->locale       = (string) $data['locale'];
        $this->title        = (string) $data['title'];
        $this->openingHours = !empty($data['openingHours']) ? (string) $data['openingHours'] : null;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return null|string
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }
}
