<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Media;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class Media
 */
class Media implements ModelInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $originalFilename;

    /**
     * @var string
     */
    private $originalFilenameSlugged;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $title;

    /**
     * @var bool
     */
    private $visible;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $mime;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $size;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var int[]
     */
    private $categoryIds;

    /**
     * @var string|null
     */
    private $linkUrl;

    /**
     * Media constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id                      = (int) $data['id'];
        $this->filename                = (string) $data['filename'];
        $this->originalFilename        = (string) $data['originalFilename'];
        $this->originalFilenameSlugged = (string) $data['originalFilenameSlugged'];
        $this->description             = !empty($data['description']) ? (string) $data['description'] : null;
        $this->title                   = !empty($data['title']) ? (string) $data['title'] : null;
        $this->visible                 = (bool) $data['visible'];
        $this->createdAt               = new \DateTime($data['created_at']);
        $this->updatedAt               = new \DateTime($data['updated_at']);
        $this->mime                    = (string) $data['mime'];
        $this->type                    = (string) $data['type'];
        $this->size                    = (int) $data['size'];
        $this->extension               = (string) $data['extension'];
        $this->categoryIds             = array_map('intval', $data['category_ids']);
        $this->linkUrl                 = !empty($data['link_url']) ? (string) $data['link_url'] : null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getOriginalFilename(): string
    {
        return $this->originalFilename;
    }

    /**
     * @return string
     */
    public function getOriginalFilenameSlugged(): string
    {
        return $this->originalFilenameSlugged;
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getMime(): string
    {
        return $this->mime;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @return \int[]
     */
    public function getCategoryIds(): array
    {
        return $this->categoryIds;
    }

    /**
     * @return null|string
     */
    public function getLinkUrl()
    {
        return $this->linkUrl;
    }
}
