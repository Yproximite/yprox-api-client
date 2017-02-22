<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\User;

use Yproximite\Api\Exception\LogicException;

/**
 * Class UserPostMessage
 */
class UserPostMessage extends AbstractUserMessage
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        if (is_null($this->getPlainPassword())) {
            throw new LogicException('The plain password should be not null.');
        }

        return parent::build();
    }
}
