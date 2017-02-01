<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\User;

use Yproximite\Api\Model\User\User;
use Yproximite\Api\Message\IdentityAwareMessageTrait;

/**
 * Class UserPatchMessage
 */
class UserPatchMessage extends AbstractUserMessage
{
    use IdentityAwareMessageTrait;

    /**
     * @param User $user
     *
     * @return self
     */
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
