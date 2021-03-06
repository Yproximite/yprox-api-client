<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Factory\ModelFactory;

/**
 * Class AbstractService
 */
abstract class AbstractService
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
     * AbstractService constructor.
     *
     * @param Client       $client
     * @param ModelFactory $modelFactory
     */
    public function __construct(Client $client, ModelFactory $modelFactory)
    {
        $this->client       = $client;
        $this->modelFactory = $modelFactory;
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return ModelFactory
     */
    protected function getModelFactory(): ModelFactory
    {
        return $this->modelFactory;
    }
}
