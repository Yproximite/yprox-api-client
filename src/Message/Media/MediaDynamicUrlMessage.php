<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Media;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class MediaDynamicUrlMessage
 */
class MediaDynamicUrlMessage implements MessageInterface
{
    use SiteAwareMessageTrait;
    use IdentityAwareMessageTrait;

    /**
     * @var string
     */
    private $format;

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(string $format)
    {
        $this->format = $format;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return null;
    }
}
