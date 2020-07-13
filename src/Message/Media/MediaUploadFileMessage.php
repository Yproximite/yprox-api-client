<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Media;

use Psr\Http\Message\StreamInterface;
use Yproximite\Api\Message\MessageInterface;

/**
 * Class MediaUploadFileMessage
 */
class MediaUploadFileMessage implements MessageInterface
{
    /**
     * @var string|null
     */
    private $filename;

    /**
     * @var string|resource|StreamInterface
     */
    private $resource;

    /**
     * @return string|null
     */
    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename(string $filename = null)
    {
        $this->filename = $filename;
    }

    /**
     * @return StreamInterface|resource|string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param StreamInterface|resource|string $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return null;
    }
}
