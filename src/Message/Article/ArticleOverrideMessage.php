<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

/**
 * Class ArticleOverrideMessage
 */
class ArticleOverrideMessage extends AbstractArticleMessage
{
    /** @var int */
    private $id;

    public function getArticleId(): int
    {
        return $this->id;
    }

    public function setArticleId(int $id): void
    {
        $this->id = $id;
    }
}
