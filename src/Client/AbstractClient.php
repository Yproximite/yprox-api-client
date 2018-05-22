<?php

namespace Yproximite\Api\Client;

use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;

abstract class AbstractClient
{
    private $httpClient;
    private $messageFactory;

    public function __construct(HttpClient $httpClient = null, MessageFactory $messageFactory = null)
    {
        $this->httpClient     = $httpClient;
        $this->messageFactory = $messageFactory;
    }

    protected function getHttpClient(): HttpClient
    {
        if ($this->httpClient === null) {
            $this->httpClient = MessageFactoryDiscovery::find();
        }

        return $this->httpClient;
    }

    protected function getMessageFactory(): MessageFactory
    {
        if ($this->messageFactory === null) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }

        return $this->messageFactory;
    }
}
