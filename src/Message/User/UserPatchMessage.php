<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\User;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Model\User\User;

/**
 * Class UserPatchMessage
 */
class UserPatchMessage extends AbstractUserMessage
{
    use IdentityAwareMessageTrait;

    public static function createFromUser(User $user): self
    {
        $message = new self();
        $message->setId($user->getId());
        $message->setFirstName($user->getFirstName());
        $message->setLastName($user->getLastName());
        $message->setEmail($user->getEmail());
        $message->setCompanyId($user->getCompanyId());

        return $message;
    }
}
