<?php
declare(strict_types=1);

namespace Yproximite\Api\Client;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Psr\Http\Message\StreamInterface;
use Http\Client\Exception\HttpException;
use Http\Discovery\MessageFactoryDiscovery;

use Yproximite\Api\Exception\LogicException;
use Yproximite\Api\Exception\InvalidResponseException;

/**
 * Class Client
 */
class Client
{
    const BASE_URL = 'https://api.yproximite.fr';

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var string
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
    private $apiTokenFresh;

    /**
     * Client constructor.
     *
     * @param HttpClient          $httpClient
     * @param string              $apiKey
     * @param string              $baseUrl
     * @param MessageFactory|null $messageFactory
     *
     * @throws LogicException
     */
    public function __construct(HttpClient $httpClient, $apiKey, $baseUrl = self::BASE_URL, MessageFactory $messageFactory = null)
    {
        if (empty($apiKey)) {
            throw new LogicException('The api key cannot be empty.');
        }

        if (empty($baseUrl)) {
            throw new LogicException('The base url cannot be empty.');
        }

        $this->httpClient     = $httpClient;
        $this->messageFactory = $messageFactory;
        $this->apiKey         = $apiKey;
        $this->baseUrl        = $baseUrl;
    }

    /**
     * Sends a request
     *
     * @param string $method
     * @param string $path
     * @param array  $data
     * @param bool   $withAuthorization
     *
     * @return array|null
     * @throws InvalidResponseException
     */
    public function sendRequest(string $method, string $path, array $data = [], bool $withAuthorization = true)
    {
        $uri   = $this->baseUrl.$path;
        $query = http_build_query($data);
        $body  = null;

        if (in_array($method, $this->getQueryMethods())) {
            if ($query !== '') {
                $uri .= '?'.$query;
            }
        } else {
            $body = $query;
        }

        $content = $withAuthorization
            ? $this->sendRequestWithAuthorization($method, $uri, $body)
            : $this->doSendRequest($method, $uri, $body, false)
        ;

        if (empty($content)) {
            return null;
        }

        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidResponseException(sprintf('Could not decode the response of "%s %s".', $method, $path));
        }

        return $data;
    }

    /**
     * Sends a request with authorization and tries to renew the api token in case of error of authentication.
     *
     * @param string                               $method
     * @param string                               $uri
     * @param resource|string|StreamInterface|null $body
     *
     * @return string
     */
    private function sendRequestWithAuthorization(string $method, string $uri, $body): string
    {
        try {
            $content = $this->doSendRequest($method, $uri, $body);
        } catch (HttpException $e) {
            if ($e->getCode() !== 401 || !$this->apiTokenFresh) {
                throw $e;
            }

            $this->resetApiToken();

            $content = $this->doSendRequest($method, $uri, $body);
        }

        return $content;
    }

    /**
     * @param string                               $method
     * @param string                               $uri
     * @param resource|string|StreamInterface|null $body
     * @param bool                                 $withAuthorization
     *
     * @return string
     */
    private function doSendRequest(string $method, string $uri, $body, bool $withAuthorization = true): string
    {
        $request = $this->getMessageFactory()->createRequest($method, $uri, [], $body);

        if ($withAuthorization) {
            $request = $request->withHeader('Authorization', $this->getAuthorizationHeader());
        }

        return (string) $this->getHttpClient()->sendRequest($request)->getBody();
    }

    /**
     * @return HttpClient
     */
    private function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * @return MessageFactory
     */
    private function getMessageFactory(): MessageFactory
    {
        if ($this->messageFactory === null) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }

        return $this->messageFactory;
    }

    /**
     * @return array
     */
    private function getQueryMethods(): array
    {
        return ['GET', 'HEAD', 'DELETE'];
    }

    /**
     * @return string
     * @throws LogicException
     */
    private function getApiToken(): string
    {
        if (!is_null($this->apiToken)) {
            $this->apiTokenFresh = false;

            return $this->apiToken;
        }

        $data = $this->sendRequest('POST', '/login_check', ['api_key' => $this->apiKey], false);

        if (!is_array($data) || !array_key_exists('token', $data)) {
            throw new LogicException('Could not retreive a token.');
        }

        return (string) $data['token'];
    }

    private function resetApiToken()
    {
        $this->apiToken      = null;
        $this->apiTokenFresh = true;
    }

    /**
     * @return string
     */
    private function getAuthorizationHeader(): string
    {
        return sprintf('Bearer %s', $this->getApiToken());
    }
}
