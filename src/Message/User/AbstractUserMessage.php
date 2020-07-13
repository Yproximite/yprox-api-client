<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\User;

use Yproximite\Api\Message\MessageInterface;

/**
 * Class AbstractUserMessage
 */
abstract class AbstractUserMessage implements MessageInterface
{
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
     * @var string|null
     */
    private $plainPassword;

    /**
     * @var string|null
     */
    private $phone;

    /**
     * @var string|null
     */
    private $defaultLocale;

    /**
     * @var int
     */
    private $companyId;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword = null)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone(string $phone = null)
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    public function setDefaultLocale(string $defaultLocale = null)
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'firstName'     => $this->getFirstName(),
            'lastName'      => $this->getLastName(),
            'email'         => $this->getEmail(),
            'plainPassword' => $this->getPlainPassword(),
            'phone'         => $this->getPhone(),
            'defaultLocale' => $this->getDefaultLocale(),
        ];
    }
}
