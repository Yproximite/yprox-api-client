<?php

namespace Yproximite\Api\Client;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;

class GraphQLClient extends AbstractClient
{
    private $graphqlEndpoint;
    private $authClient;

    public function __construct(AuthClient $authClient, string $graphqlEndpoint = null, HttpClient $httpClient = null, MessageFactory $messageFactory = null)
    {
        parent::__construct($httpClient, $messageFactory);

        $this->authClient      = $authClient;
        $this->graphqlEndpoint = $graphqlEndpoint;
    }
}
