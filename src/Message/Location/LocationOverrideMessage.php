<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Location;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class LocationOverrideMessage
 */
class LocationOverrideMessage implements MessageInterface
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
