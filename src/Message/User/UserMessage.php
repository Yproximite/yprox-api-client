<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\User;

use Yproximite\Api\Message\MessageInterface;

class UserMessage implements MessageInterface
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

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return null|string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param null|string $plainPassword
     */
    public function setPlainPassword(string $plainPassword = null)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return null|string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param null|string $phone
     */
    public function setPhone(string $phone = null)
    {
        $this->phone = $phone;
    }

    /**
     * @return null|string
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    /**
     * @param null|string $defaultLocale
     */
    public function setDefaultLocale(string $defaultLocale = null)
    {
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * @return int
     */
    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    /**
     * @param int $companyId
     */
    public function setCompanyId(int $companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array
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
