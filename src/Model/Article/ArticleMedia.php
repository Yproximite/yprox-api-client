<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\Article;

use Yproximite\Api\Model\Media\Media;
use Yproximite\Api\Model\ModelInterface;

/**
 * Class ArticleMedia
 */
class ArticleMedia implements ModelInterface
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
     */
    public function __construct(array $data)
    {
        $this->id           = (int) $data['id'];
        $this->displayOrder = (int) $data['display_order'];
        $this->media        = new Media($data['media']);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    public function getMedia(): Media
    {
        return $this->media;
    }
}
