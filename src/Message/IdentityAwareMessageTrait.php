<?php
declare(strict_types=1);

namespace Yproximite\Api\Message;

/**
 * Trait IdentityAwareMessageTrait
 */
trait IdentityAwareMessageTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
}
