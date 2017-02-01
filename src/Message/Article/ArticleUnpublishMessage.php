<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class ArticleUnpublishMessage
 */
class ArticleUnpublishMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * @var int[]
     */
    private $articleIds = [];

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
    public function build(): array
    {
        return [
            'articles' => $this->articleIds,
        ];
    }
}
