<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\Article;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class CategoryTranslation
 */
class CategoryTranslation implements ModelInterface
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
    private $description;

    /**
     * CategoryTranslation constructor.
     */
    public function __construct(array $data)
    {
        $this->locale      = (string) $data['locale'];
        $this->title       = (string) $data['title'];
        $this->description = !empty($data['description']) ? (string) $data['description'] : null;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }
}
