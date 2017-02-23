<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Model\Media\Media;
use Yproximite\Api\Message\Media\MediaUploadMessage;
use Yproximite\Api\Message\Media\MediaDynamicUrlMessage;

/**
 * Class MediaService
 */
class MediaService extends AbstractService implements ServiceInterface
{
    /**
     * @param MediaDynamicUrlMessage $message
     *
     * @return string
     */
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
     * @param MediaUploadMessage $message
     *
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
