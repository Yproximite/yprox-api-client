<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\CallTracking;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class CallTracking
 */
class CallTracking implements ModelInterface
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
     * @var string
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

    /**
     * CallTracking constructor.
     */
    public function __construct(array $data)
    {
        $this->id               = (int) $data['id'];
        $this->name             = (string) $data['name'];
        $this->phoneDid         = (string) $data['phoneDid'];
        $this->phoneDestination = (string) $data['phoneDestination'];
        $this->callerId         = (bool) $data['callerId'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneDid(): string
    {
        return $this->phoneDid;
    }

    public function getPhoneDestination(): string
    {
        return $this->phoneDestination;
    }

    public function hasCallerId(): bool
    {
        return $this->callerId;
    }
}
