<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Article;

/**
 * Class CategoryTranslation
 */
class CategoryTranslation
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
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->locale      = (string) $data['locale'];
        $this->title       = (string) $data['title'];
        $this->description = !empty($data['description']) ? (string) $data['description'] : null;
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
    public function getDescription()
    {
        return $this->description;
    }
}
