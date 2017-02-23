<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Media;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;
use Yproximite\Api\Message\IdentityAwareMessageTrait;

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

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
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
