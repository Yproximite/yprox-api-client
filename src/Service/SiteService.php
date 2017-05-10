<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Model\Site\Site;
use Yproximite\Api\Message\Site\SitePostMessage;
use Yproximite\Api\Message\Site\SitePatchMessage;
use Yproximite\Api\Message\Site\PlatformChildrenListMessage;

/**
 * Class SiteService
 */
class SiteService extends AbstractService implements ServiceInterface
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
     * @param int $id
     *
     * @return Site
     */
    public function getSite(int $id): Site
    {
        $path = sprintf('sites/%d', $id);

        $response = $this->getClient()->sendRequest('GET', $path);

        /** @var Site $model */
        $model = $this->getModelFactory()->create(Site::class, $response);

        return $model;
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
     * @param SitePatchMessage $message
     *
     * @return Site
     */
    public function patchSite(SitePatchMessage $message): Site
    {
        $path = sprintf('sites/%d', $message->getId());
        $data = ['api_site' => $message->build()];

        $response = $this->getClient()->sendRequest('PATCH', $path, $data);

        /** @var Site $model */
        $model = $this->getModelFactory()->create(Site::class, $response);

        return $model;
    }

    /**
     * @param int $id
     */
    public function deleteSite(int $id)
    {
        $path = sprintf('sites/%d', $id);

        $this->getClient()->sendRequest('DELETE', $path);
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
