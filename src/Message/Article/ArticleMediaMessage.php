<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Model\Article\ArticleMedia;

/**
 * Class ArticleMediaMessage
 */
class ArticleMediaMessage implements MessageInterface
{
    /**
     * @var int
     */
    private $mediaId;

    /**
     * @var int|null
     */
    private $displayOrder;

    public static function createFromArticleMedia(ArticleMedia $media): self
    {
        $message = new self();
        $message->setMediaId($media->getMedia()->getId());
        $message->setDisplayOrder($media->getDisplayOrder());

        return $message;
    }

    public function getMediaId(): int
    {
        return $this->mediaId;
    }

    public function setMediaId(int $mediaId)
    {
        $this->mediaId = $mediaId;
    }

    /**
     * @return int|null
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder(int $displayOrder = null)
    {
        $this->displayOrder = $displayOrder;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'media'        => $this->getMediaId(),
            'displayOrder' => $this->getDisplayOrder(),
        ];
    }
}
