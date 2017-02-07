<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Message\Site\PlatformChildrenListMessage;
use Yproximite\Api\Model\Site\Site;
use Yproximite\Api\Message\Site\SitePostMessage;

/**
 * Class SiteService
 */
final class SiteService extends AbstractService implements ServiceInterface
{
    /**
     * @return Site[]
     */
    public function getSites(): array
    {
        $path = 'sites';

        $response = $this->getClient()->sendRequest('GET', $path);

        /** @var Site[] $models */
        $models = $this->getModelFactory()->createMany(Site::class, $response);

        return $models;
    }

    /**
     * @param SitePostMessage $message
     *
     * @return Site
     */
    public function postSite(SitePostMessage $message): Site
    {
        $path = 'sites';
        $data = ['api_site' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

        /** @var Site $model */
        $model = $this->getModelFactory()->create(Site::class, $response);

        return $model;
    }

    /**
     * @param PlatformChildrenListMessage $message
     *
     * @return Site[]
     */
    public function getPlatformChildren(PlatformChildrenListMessage $message): array
    {
        $path = sprintf('platform/%d/children', $message->getSiteId());

        $response = $this->getClient()->sendRequest('GET', $path);

        /** @var Site[] $models */
        $models = $this->getModelFactory()->createMany(Site::class, $response);

        return $models;
    }
}
