<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Field;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class Field
 */
class Field implements ModelInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $description;

    /**
     * @var FieldTranslation[]
     */
    private $translations;

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
     * Field constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $translations = array_map(function (array $data, string $locale) {
            return new FieldTranslation($data + compact('locale'));
        }, array_values($data['translations']), array_keys($data['translations']));

        $this->id                = (int) $data['id'];
        $this->token             = (string) $data['token'];
        $this->description       = (string) $data['description'];
        $this->translations      = $translations;
        $this->dataParentId      = !empty($data['dataParent']) ? (int) $data['dataParent'] : null;
        $this->createdAt         = new \DateTime($data['createdAt']['date']);
        $this->updatedAt         = new \DateTime($data['updatedAt']['date']);
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
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return FieldTranslation[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
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
     * @return string
     */
    public function getInheritanceStatus(): string
    {
        return $this->inheritanceStatus;
    }
}
