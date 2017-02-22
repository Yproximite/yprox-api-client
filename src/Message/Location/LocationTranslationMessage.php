<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Location;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\LocaleAwareMessageTrait;
use Yproximite\Api\Model\Location\LocationTranslation;

/**
 * Class LocationTranslationMessage
 */
class LocationTranslationMessage implements MessageInterface
{
    use LocaleAwareMessageTrait;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string|null
     */
    private $openingHours;

    /**
     * @param LocationTranslation $translation
     *
     * @return self
     */
    public static function createFromLocationTranslation(LocationTranslation $translation): self
    {
        $message = new self();
        $message->setLocale($translation->getLocale());
        $message->setTitle($translation->getTitle());
        $message->setOpeningHours($translation->getOpeningHours());

        return $message;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    /**
     * @param null|string $openingHours
     */
    public function setOpeningHours($openingHours)
    {
        $this->openingHours = $openingHours;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'title'        => $this->getTitle(),
            'openingHours' => $this->getOpeningHours(),
        ];
    }
}
