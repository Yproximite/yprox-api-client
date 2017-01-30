<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Factory\ModelFactory;

/**
 * Class ServiceAggregator
 */
final class ServiceAggregator
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
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client       = $client;
        $this->modelFactory = new ModelFactory();
    }

    /**
     * @return ArticleService
     */
    public function article(): ArticleService
    {
        /** @var ArticleService $service */
        $service = $this->getService(ArticleService::class);

        return $service;
    }

    /**
     * @param string $class
     *
     * @return ServiceInterface
     */
    private function getService(string $class): ServiceInterface
    {
        if (!array_key_exists($class, $this->services)) {
            $this->services[$class] = new $class($this->client, $this->modelFactory);
        }

        return $this->services[$class];
    }
}
