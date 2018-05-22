<?php

namespace Yproximite\Api\Client;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Yproximite\Api\Exception\AuthenticationException;
use Yproximite\Api\Exception\InvalidResponseException;

class AuthClient extends AbstractClient
{
    private $apiKey;
    private $apiToken = null;
    private $loginEndpoint;

    public function __construct(string $apiKey, string $loginEndpoint = null, HttpClient $httpClient = null, MessageFactory $messageFactory = null)
    {
        parent::__construct($httpClient, $messageFactory);

        $this->apiKey        = $apiKey;
        $this->loginEndpoint = $loginEndpoint ?? 'https://api.yproximite.fr/login_check';
    }

    /**
     * @throws InvalidApiKeyException
     * @throws AuthenticationException
     * @throws InvalidResponseException
     */
    public function auth()
    {
        if ($this->isAuthenticated()) {
            return;
        }

        $request  = $this->getMessageFactory()->createRequest('POST', $this->loginEndpoint, [], http_build_query(['api_key' => $this->apiKey]));
        $response = $this->getHttpClient()->sendRequest($request);
        $contents = json_decode((string) $response->getBody(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidResponseException('Could not decode response.', $request, $response);
        }

        if ($response->getStatusCode() === 401) {
            throw new AuthenticationException('Your API key is not valid.', $request, $response);
        }

        $this->apiToken = $contents['token'];
    }

    public function isAuthenticated(): bool
    {
        return $this->apiToken !== null;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }
}
