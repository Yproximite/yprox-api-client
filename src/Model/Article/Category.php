<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\Article;

use Yproximite\Api\Model\Inheritance\InheritanceStatuses;
use Yproximite\Api\Model\ModelInterface;

/**
 * Class Category
 */
class Category implements ModelInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var CategoryTranslation[]
     */
    private $translations;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @var int|null
     */
    private $dataParentId;

    /**
     * @var int|null
     */
    private $parentRootId;

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
    private $inheritanceStatus;

    /**
     * Category constructor.
     */
    public function __construct(array $data)
    {
        $translations = array_map(function (array $data) {
            return new CategoryTranslation($data);
        }, $data['translations']);

        $this->id                = (int) $data['id'];
        $this->translations      = $translations;
        $this->enabled           = (bool) $data['enabled'];
        $this->dataParentId      = !empty($data['dataParent']) ? (int) $data['dataParent'] : null;
        $this->parentRootId      = (int) $data['parentRootId'];
        $this->createdAt         = new \DateTime($data['createdAt']['date']);
        $this->updatedAt         = new \DateTime($data['updatedAt']['date']);
        $this->inheritanceStatus = (string) $data['inheritance_status'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return CategoryTranslation[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return int|null
     */
    public function getDataParentId()
    {
        return $this->dataParentId;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @see InheritanceStatuses::getValues()
     */
    public function getInheritanceStatus(): string
    {
        return $this->inheritanceStatus;
    }

    /**
     * @return int|null
     */
    public function getParentRootId()
    {
        return $this->parentRootId;
    }

    /**
     * @param int|null $parentRootId
     */
    public function setParentRootId($parentRootId)
    {
        $this->parentRootId = $parentRootId;
    }
}
