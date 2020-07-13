<?php

declare(strict_types=1);

namespace Yproximite\Api\Client;

use Http\Client\Exception\HttpException;
use Http\Client\Exception\TransferException as HttpTransferException;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Yproximite\Api\Exception\AuthenficationException;
use Yproximite\Api\Exception\InvalidResponseException;
use Yproximite\Api\Exception\LogicException;
use Yproximite\Api\Exception\RequestException;
use Yproximite\Api\Exception\TransferException;

/**
 * Class Client
 */
class Client
{
    const BASE_URL = 'https://api.yproximite.fr';

    /**
     * @var string|null
     */
    private $baseUrl;

    /**
     * @var string|null
     */
    private $apiKey;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var MessageFactory|null
     */
    private $messageFactory;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * Used to determine if token was used. In some cases the token could be invalidated during the usage of the API.
     *
     * @var bool
     */
    private $apiTokenFresh = true;

    /**
     * Client constructor.
     */
    public function __construct(
        HttpClient $httpClient,
        string $apiKey = null,
        string $baseUrl = null,
        MessageFactory $messageFactory = null
    ) {
        $this->httpClient     = $httpClient;
        $this->messageFactory = $messageFactory;
        $this->apiKey         = $apiKey;
        $this->baseUrl        = $baseUrl;
    }

    public function setBaseUrl(string $baseUrl = null)
    {
        $this->baseUrl = $baseUrl;
    }

    public function setApiKey(string $apiKey = null)
    {
        $this->apiKey = $apiKey;

        $this->resetApiToken();
    }

    /**
     * Sends a request
     *
     * @param array|resource|string|StreamInterface|null $body
     *
     * @throws TransferException
     * @throws InvalidResponseException
     * @throws AuthenficationException
     */
    public function sendRequest(string $method, string $path, $body = null, array $headers = [])
    {
        $request = $this->createRequest($method, $path, $body, $headers);

        try {
            $content = $this->doSendRequest($request);
        } catch (InvalidResponseException $e) {
            if (401 === $e->getResponse()->getStatusCode() && !$this->apiTokenFresh) {
                $this->resetApiToken();

                $request = $this->createRequest($method, $path, $body, $headers);
                $content = $this->doSendRequest($request);
            } else {
                throw $e;
            }
        }

        return $content;
    }

    /**
     * @param null $body
     */
    private function createRequest(
        string $method,
        string $path,
        $body = null,
        array $headers = [],
        bool $withAuthorization = true
    ): RequestInterface {
        $uri  = $this->getSafeBaseUrl();
        $uri .= '/'.$path;

        $rawData = \is_array($body) ? http_build_query($body) : $body;
        $body    = null;

        if (\in_array($method, $this->getQueryMethods())) {
            if (\is_string($rawData) && '' !== $rawData) {
                $uri .= '?'.$rawData;
            }
        } else {
            $body = $rawData;
        }

        $baseHeaders = ['Content-Type' => 'application/x-www-form-urlencoded'];

        if ($withAuthorization) {
            $baseHeaders['Authorization'] = $this->getAuthorizationHeader();
        }

        return $this->getMessageFactory()->createRequest($method, $uri, $headers + $baseHeaders, $body);
    }

    private function getSafeBaseUrl(): string
    {
        return !\is_null($this->baseUrl) ? $this->baseUrl : self::BASE_URL;
    }

    private function doSendRequest(RequestInterface $request)
    {
        try {
            $response = $this->getHttpClient()->sendRequest($request);
        } catch (HttpTransferException $e) {
            throw new TransferException($e->getMessage(), $request, $e instanceof HttpException ? $e->getResponse() : null);
        }

        if ($response->getStatusCode() >= 400) {
            throw new InvalidResponseException('Bad response status code.', $request, $response);
        }

        $rawData = (string) $response->getBody();

        if (empty($rawData)) {
            return null;
        }

        $data = json_decode($rawData, true);

        if (\JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidResponseException('Could not decode the response.', $request, $response);
        }

        return $data;
    }

    private function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    private function getMessageFactory(): MessageFactory
    {
        if (null === $this->messageFactory) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }

        return $this->messageFactory;
    }

    /**
     * Returns all methods that uses query string to transfer a request data
     */
    private function getQueryMethods(): array
    {
        return ['GET', 'HEAD', 'DELETE'];
    }

    private function getApiToken(): string
    {
        if (!\is_null($this->apiToken)) {
            $this->apiTokenFresh = false;
        } else {
            $this->updateApiToken();
        }

        return $this->apiToken;
    }

    private function updateApiToken()
    {
        if (\is_null($this->apiKey)) {
            throw new LogicException('The api key cannot be empty.');
        }

        $request = $this->createRequest('POST', 'login_check', ['api_key' => $this->apiKey], [], false);

        try {
            $data = $this->doSendRequest($request);
        } catch (RequestException $e) {
            throw new AuthenficationException('Could not request a token.');
        }

        if (!\is_array($data) || !\array_key_exists('token', $data)) {
            throw new AuthenficationException('Could not retreive a token.');
        }

        $this->apiToken = (string) $data['token'];
    }

    private function resetApiToken()
    {
        $this->apiToken      = null;
        $this->apiTokenFresh = true;
    }

    private function getAuthorizationHeader(): string
    {
        return sprintf('Bearer %s', $this->getApiToken());
    }
}
