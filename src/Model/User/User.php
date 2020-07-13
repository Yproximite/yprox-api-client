<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\User;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class User
 */
class User implements ModelInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var int|null
     */
    private $companyId;

    /**
     * User constructor.
     */
    public function __construct(array $data)
    {
        $this->id        = (int) $data['id'];
        $this->firstName = (string) $data['firstName'];
        $this->lastName  = (string) $data['lastName'];
        $this->email     = (string) $data['email'];
        $this->companyId = !empty($data['company']) ? (int) $data['company'] : null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }
}
