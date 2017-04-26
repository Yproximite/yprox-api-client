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
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id               = (int) $data['id'];
        $this->name             = (string) $data['name'];
        $this->phoneDid         = (string) $data['phoneDid'];
        $this->phoneDestination = (string) $data['phoneDestination'];
        $this->callerId         = (bool) $data['callerId'];
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPhoneDid(): string
    {
        return $this->phoneDid;
    }

    /**
     * @return string
     */
    public function getPhoneDestination(): string
    {
        return $this->phoneDestination;
    }

    /**
     * @return boolean
     */
    public function hasCallerId(): bool
    {
        return $this->callerId;
    }
}
