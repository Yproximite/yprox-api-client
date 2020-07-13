<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Location;

use Yproximite\Api\Message\LocaleAwareMessageTrait;
use Yproximite\Api\Message\MessageInterface;
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

    public static function createFromLocationTranslation(LocationTranslation $translation): self
    {
        $message = new self();
        $message->setLocale($translation->getLocale());
        $message->setTitle($translation->getTitle());
        $message->setOpeningHours($translation->getOpeningHours());

        return $message;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    /**
     * @param string|null $openingHours
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
