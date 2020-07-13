<?php

declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Factory\ModelFactory;

/**
 * Class ServiceAggregator
 */
class ServiceAggregator
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var ModelFactory
     */
    private $modelFactory;

    /**
     * @var ServiceInterface[]
     */
    private $services = [];

    /**
     * ServiceAggregator constructor.
     */
    public function __construct(Client $client)
    {
        $this->client       = $client;
        $this->modelFactory = new ModelFactory();
    }

    public function article(): ArticleService
    {
        /** @var ArticleService $service */
        $service = $this->getService(ArticleService::class);

        return $service;
    }

    public function callTracking(): CallTrackingService
    {
        /** @var CallTrackingService $service */
        $service = $this->getService(CallTrackingService::class);

        return $service;
    }

    public function company(): CompanyService
    {
        /** @var CompanyService $service */
        $service = $this->getService(CompanyService::class);

        return $service;
    }

    public function field(): FieldService
    {
        /** @var FieldService $service */
        $service = $this->getService(FieldService::class);

        return $service;
    }

    public function location(): LocationService
    {
        /** @var LocationService $service */
        $service = $this->getService(LocationService::class);

        return $service;
    }

    public function media(): MediaService
    {
        /** @var MediaService $service */
        $service = $this->getService(MediaService::class);

        return $service;
    }

    public function site(): SiteService
    {
        /** @var SiteService $service */
        $service = $this->getService(SiteService::class);

        return $service;
    }

    public function user(): UserService
    {
        /** @var UserService $service */
        $service = $this->getService(UserService::class);

        return $service;
    }

    public function teamWorker(): TeamWorkerService
    {
        /** @var TeamWorkerService $service */
        $service = $this->getService(TeamWorkerService::class);

        return $service;
    }

    private function getService(string $class): ServiceInterface
    {
        if (!\array_key_exists($class, $this->services)) {
            $this->services[$class] = new $class($this->client, $this->modelFactory);
        }

        return $this->services[$class];
    }
}
