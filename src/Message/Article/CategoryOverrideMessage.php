<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class CategoryOverrideMessage
 */
class CategoryOverrideMessage implements MessageInterface
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
