<?php
declare(strict_types=1);

namespace Yproximite\Api\Message;

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

    /**
     * @param ArticleMedia $media
     *
     * @return self
     */
    public static function createFromArticleMedia(ArticleMedia $media): self
    {
        $message = new ArticleMediaMessage();
        $message->setMediaId($media->getMedia()->getId());
        $message->setDisplayOrder($media->getDisplayOrder());

        return $message;
    }

    /**
     * @return int
     */
    public function getMediaId(): int
    {
        return $this->mediaId;
    }

    /**
     * @param int $mediaId
     */
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

    /**
     * @param int|null $displayOrder
     */
    public function setDisplayOrder(int $displayOrder = null)
    {
        $this->displayOrder = $displayOrder;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array
    {
        return [
            'media'        => $this->mediaId,
            'displayOrder' => $this->displayOrder,
        ];
    }
}
