<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Site;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class PlatformChildrenListMessage
 */
class PlatformChildrenListMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return null;
    }
}
