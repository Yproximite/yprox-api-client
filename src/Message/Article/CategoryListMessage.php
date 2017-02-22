<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class CategoryListMessage
 */
class CategoryListMessage implements MessageInterface
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
