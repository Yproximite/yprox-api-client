<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Location;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class LocationListMessage
 */
class LocationListMessage implements MessageInterface
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
