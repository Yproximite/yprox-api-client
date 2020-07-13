<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Field;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class FieldOverrideMessage
 */
class FieldOverrideMessage implements MessageInterface
{
    use SiteAwareMessageTrait;
    use IdentityAwareMessageTrait;

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return null;
    }
}
