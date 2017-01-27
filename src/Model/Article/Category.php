<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Article;

use Yproximite\Api\Model\Inheritance\InheritanceStatuses;

/**
 * Class Category
 */
class Category
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
     *
     * @param array $data
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
        $this->createdAt         = new \DateTime($data['createdAt']);
        $this->updatedAt         = new \DateTime($data['updatedAt']);
        $this->inheritanceStatus = (string) $data['inheritance_status'];
    }

    /**
     * @return int
     */
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

    /**
     * @return bool
     */
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
     * @see InheritanceStatuses::getValues()
     *
     * @return string
     */
    public function getInheritanceStatus(): string
    {
        return $this->inheritanceStatus;
    }
}
