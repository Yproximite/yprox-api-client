<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\Article;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class ArticleTranslation
 */
class ArticleTranslation implements ModelInterface
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
     */
    public function __construct(array $data)
    {
        $this->locale = (string) $data['locale'];
        $this->title  = (string) $data['title'];
        $this->body   = !empty($data['body']) ? (string) $data['body'] : null;
        $this->slug   = (string) $data['slug'];
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
    public function getBody()
    {
        return $this->body;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
