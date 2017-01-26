<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Client\Client;

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
     * AbstractService constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }
}
