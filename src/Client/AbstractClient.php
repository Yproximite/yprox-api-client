<?php

declare(strict_types=1);

namespace Yproximite\Api\Client;

use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Yproximite\Api\Exception\AuthenticationException;
use Yproximite\Api\Exception\InvalidResponseException;

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
        if (null === $this->httpClient) {
            $this->httpClient = MessageFactoryDiscovery::find();
        }

        return $this->httpClient;
    }

    protected function getMessageFactory(): MessageFactory
    {
        if (null === $this->messageFactory) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }

        return $this->messageFactory;
    }

    protected function createRequest(string $method, string $url, array $headers = [], $body = null): RequestInterface
    {
        return $this->getMessageFactory()->createRequest($method, $url, $headers, $body);
    }

    /**
     * @throws AuthenticationException
     * @throws InvalidResponseException
     * @throws \Http\Client\Exception
     */
    protected function sendRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->getHttpClient()->sendRequest($request);

        if (401 === $response->getStatusCode()) {
            throw new AuthenticationException('Your API key is not valid.', $request, $response);
        }

        $this->extractJson($request, $response);

        return $response;
    }

    /**
     * @throws InvalidResponseException
     */
    protected function extractJson(RequestInterface $request, ResponseInterface $response): array
    {
        $body = (string) $response->getBody();
        $body = trim($body);
        $json = json_decode($body, true);

        if (!\in_array($body[0], ['{', '['], true) || JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidResponseException('Could not decode response.', $request, $response);
        }

        return $json;
    }
}
