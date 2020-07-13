<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\TeamWorker;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class AbstractTeamWorkerMessage
 */
abstract class AbstractTeamWorkerMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'lastName'  => $this->getLastName(),
            'firstName' => $this->getFirstName(),
        ];
    }
}
