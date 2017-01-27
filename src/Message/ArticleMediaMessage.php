<?php
declare(strict_types=1);

namespace Yproximite\Api\Message;

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
