<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Article;

/**
 * Class ArticleTranslation
 */
class ArticleTranslation
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
    private $body;

    /**
     * @var string
     */
    private $slug;

    /**
     * ArticleTranslation constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->locale = (string) $data['locale'];
        $this->title  = (string) $data['title'];
        $this->body   = !empty($data['body']) ? (string) $data['body'] : null;
        $this->slug   = (string) $data['slug'];
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
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}
