<?php

namespace Yproximite\Api;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;

class Client
{
    private $httpClient;
    private $apiKey;
    private $graphqlEndpoint;
    private $messageFactory;

    public function __construct(HttpClient $httpClient, string $apiKey, string $graphqlEndpoint = null, MessageFactory $messageFactory = null)
    {
        $this->httpClient      = $httpClient;
        $this->apiKey          = $apiKey;
        $this->graphqlEndpoint = $graphqlEndpoint;
        $this->messageFactory  = $messageFactory;
    }
}
