<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class CategoryArticleListMessage
 */
class CategoryArticleListMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * @var int
     */
    private $categoryId;

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return null;
    }
}
