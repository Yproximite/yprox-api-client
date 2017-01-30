<?php
declare(strict_types=1);

namespace Yproximite\Api\Message;

/**
 * Trait LocaleAwareMessageTrait
 */
trait LocaleAwareMessageTrait
{
    /**
     * @var string
     */
    protected $locale;

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    }
}
