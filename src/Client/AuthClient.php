<?php

declare(strict_types=1);

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
     * @throws AuthenticationException
     * @throws InvalidResponseException
     * @throws \Http\Client\Exception
     */
    public function auth(): void
    {
        if ($this->isAuthenticated()) {
            return;
        }

        $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
        $body    = http_build_query(['api_key' => $this->apiKey]);

        $request  = $this->createRequest('POST', $this->loginEndpoint, $headers, $body);
        $response = $this->sendRequest($request);
        $json     = $this->extractJson($request, $response);

        $this->apiToken = $json['token'];
    }

    public function isAuthenticated(): bool
    {
        return null !== $this->apiToken;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getApiToken(): ?string
    {
        return $this->apiToken;
    }

    public function clearApiToken(): void
    {
        $this->apiKey = null;
    }
}
