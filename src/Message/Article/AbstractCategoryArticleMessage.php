<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class AbstractCategoryArticleMessage
 */
abstract class AbstractCategoryArticleMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * @var int
     */
    private $categoryId;

    /**
     * @var int[]
     */
    private $articleIds = [];

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return int[]
     */
    public function getArticleIds(): array
    {
        return $this->articleIds;
    }

    /**
     * @param int[] $articleIds
     */
    public function setArticleIds(array $articleIds)
    {
        $this->articleIds = $articleIds;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'category' => $this->getCategoryId(),
            'articles' => $this->getArticleIds(),
        ];
    }
}
