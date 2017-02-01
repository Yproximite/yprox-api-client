<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Company;

use Yproximite\Api\Message\MessageInterface;

/**
 * Class AbstractCompanyMessage
 */
abstract class AbstractCompanyMessage implements MessageInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int|null
     */
    private $parentId;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int|null $parentId
     */
    public function setParentId(int $parentId = null)
    {
        $this->parentId = $parentId;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array
    {
        return [
            'companyName' => $this->getName(),
            'parent'      => $this->getParentId(),
        ];
    }
}
