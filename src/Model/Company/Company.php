<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\Company;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class Company
 */
class Company implements ModelInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int|null
     */
    private $parentId;

    /**
     * Company constructor.
     */
    public function __construct(array $data)
    {
        $this->id       = (int) $data['id'];
        $this->name     = (string) $data['companyName'];
        $this->parentId = !empty($data['parent']) ? (int) $data['parent'] : null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getParentId()
    {
        return $this->parentId;
    }
}
