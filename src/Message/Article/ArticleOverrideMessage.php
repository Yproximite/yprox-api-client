<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

class ArticleOverrideMessage extends AbstractArticleMessage
{

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
