<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Media;

use Http\Discovery\StreamFactoryDiscovery;
use Http\Message\MultipartStream\MultipartStreamBuilder;

use Yproximite\Api\Exception\LogicException;
use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class MediaUploadMessage
 */
class MediaUploadMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * @var MediaUploadFileMessage[]
     */
    private $files = [];

    /**
     * @var MultipartStreamBuilder|null
     */
    private $builder;

    /**
     * @return MediaUploadFileMessage[]
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param MediaUploadFileMessage $file
     */
    public function addFile(MediaUploadFileMessage $file)
    {
        $this->files[] = $file;
    }

    /**
     * @param MediaUploadFileMessage $file
     */
    public function removeFile(MediaUploadFileMessage $file)
    {
        array_splice($this->files, array_search($file, $this->files), 1);
    }

    /**
     * @param string|null $boundary
     */
    public function initBuilder(string $boundary = null)
    {
        $streamFactory = StreamFactoryDiscovery::find();
        $builder       = new MultipartStreamBuilder($streamFactory);

        if (!is_null($boundary)) {
            $builder->setBoundary($boundary);
        }

        foreach ($this->getFiles() as $i => $file) {
            $options = [];

            if (!is_null($file->getFilename())) {
                $options['filename'] = $file->getFilename();
            }

            $builder->addResource(sprintf('api_upload_media[medias][%d]', $i), $file->getResource(), $options);
        }

        $this->builder = $builder;
    }

    /**
     * @return array
     */
    public function buildHeaders(): array
    {
        if (is_null($this->builder)) {
            throw new LogicException('You need to initialize the builder before call this method.');
        }

        return [
            'Content-Type' => sprintf('multipart/form-data; boundary="%s"', $this->builder->getBoundary()),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        if (is_null($this->builder)) {
            throw new LogicException('You need to initialize the builder before call this method.');
        }

        return $this->builder->build();
    }
}
