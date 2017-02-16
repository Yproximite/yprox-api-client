<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Model\Location\Location;
use Yproximite\Api\Message\Location\LocationListMessage;
use Yproximite\Api\Message\Location\LocationPostMessage;
use Yproximite\Api\Message\Location\LocationPatchMessage;
use Yproximite\Api\Message\Location\LocationOverrideMessage;

/**
 * Class LocationService
 */
class LocationService extends AbstractService implements ServiceInterface
{
    /**
     * @param LocationListMessage $message
     *
     * @return Location[]
     */
    public function getLocations(LocationListMessage $message): array
    {
        $path = sprintf('sites/%d/locations', $message->getSiteId());

        $response = $this->getClient()->sendRequest('GET', $path);

        /** @var Location[] $models */
        $models = $this->getModelFactory()->createMany(Location::class, $response);

        return $models;
    }

    /**
     * @param LocationPostMessage $message
     *
     * @return Location
     */
    public function postLocation(LocationPostMessage $message): Location
    {
        $path = sprintf('sites/%d/locations', $message->getSiteId());
        $data = ['api_location' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

        /** @var Location $model */
        $model = $this->getModelFactory()->create(Location::class, $response);

        return $model;
    }

    /**
     * @param LocationPatchMessage $message
     *
     * @return Location
     */
    public function patchLocation(LocationPatchMessage $message): Location
    {
        $path = sprintf('sites/%d/locations/%d', $message->getSiteId(), $message->getId());
        $data = ['api_location' => $message->build()];

        $response = $this->getClient()->sendRequest('PATCH', $path, $data);

        /** @var Location $model */
        $model = $this->getModelFactory()->create(Location::class, $response);

        return $model;
    }

    /**
     * @param LocationOverrideMessage $message
     *
     * @return Location
     */
    public function overrideLocation(LocationOverrideMessage $message): Location
    {
        $path = sprintf('sites/%d/locations/%d/override', $message->getSiteId(), $message->getId());

        $response = $this->getClient()->sendRequest('GET', $path);

        /** @var Location $model */
        $model = $this->getModelFactory()->create(Location::class, $response);

        return $model;
    }
}
