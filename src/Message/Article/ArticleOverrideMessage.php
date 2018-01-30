<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

/**
 * Class ArticleOverrideMessage
 *
 * @package Yproximite\Api\Message\Article
 */
class ArticleOverrideMessage extends AbstractArticleMessage
{

    /** @var int */
    private $id;

    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setArticleId(int $id): void
    {
        $this->id = $id;
    }
}
