<?php

declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Message\Media\MediaDynamicUrlMessage;
use Yproximite\Api\Message\Media\MediaUploadMessage;
use Yproximite\Api\Model\Media\Media;

/**
 * Class MediaService
 */
class MediaService extends AbstractService implements ServiceInterface
{
    public function getMediaDynamicUrl(MediaDynamicUrlMessage $message): string
    {
        $path = sprintf(
            'sites/%d/media/%d/dynamic_url/%s',
            $message->getSiteId(),
            $message->getId(),
            $message->getFormat()
        );

        $response = $this->getClient()->sendRequest('GET', $path);

        return (string) $response['url'];
    }

    /**
     * @return Media[]
     */
    public function uploadMedias(MediaUploadMessage $message): array
    {
        $message->initBuilder();

        $path    = sprintf('sites/%d/uploads/media', $message->getSiteId());
        $body    = $message->build();
        $headers = $message->buildHeaders();

        $response = $this->getClient()->sendRequest('POST', $path, $body, $headers);

        /** @var Media[] $model */
        $model = $this->getModelFactory()->createMany(Media::class, $response);

        return $model;
    }
}
