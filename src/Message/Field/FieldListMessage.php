<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Field;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class FieldListMessage
 */
class FieldListMessage implements MessageInterface
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
