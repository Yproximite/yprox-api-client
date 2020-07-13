<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\CallTracking;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class AbstractCallTrackingMessage
 */
abstract class AbstractCallTrackingMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $phoneDid;

    /**
     * @var string
     */
    private $phoneDestination;

    /**
     * @var bool
     */
    private $callerId;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getPhoneDid()
    {
        return $this->phoneDid;
    }

    public function setPhoneDid(string $phoneDid = null)
    {
        $this->phoneDid = $phoneDid;
    }

    public function getPhoneDestination(): string
    {
        return $this->phoneDestination;
    }

    public function setPhoneDestination(string $phoneDestination)
    {
        $this->phoneDestination = $phoneDestination;
    }

    public function hasCallerId(): bool
    {
        return $this->callerId;
    }

    public function setCallerId(bool $callerId)
    {
        $this->callerId = $callerId;
    }
}
