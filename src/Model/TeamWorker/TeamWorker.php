<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\TeamWorker;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class TeamWorker
 */
class TeamWorker implements ModelInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $firstName;

    /**
     * TeamWorker constructor.
     */
    public function __construct(array $data)
    {
        $this->id        = (int) $data['id'];
        $this->lastName  = (string) $data['lastName'];
        $this->firstName = (string) $data['firstName'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }
}
