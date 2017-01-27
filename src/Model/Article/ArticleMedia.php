<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Article;

use Yproximite\Api\Model\Media\Media;

/**
 * Class ArticleMedia
 */
class ArticleMedia
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $displayOrder;

    /**
     * @var Media
     */
    private $media;

    /**
     * ArticleMedia constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id           = (int) $data['id'];
        $this->displayOrder = (int) $data['display_order'];
        $this->media        = new Media($data['media']);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    /**
     * @return Media
     */
    public function getMedia(): Media
    {
        return $this->media;
    }
}
