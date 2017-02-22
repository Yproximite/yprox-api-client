<?php
declare(strict_types=1);

namespace Yproximite\Api\Client;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Psr\Http\Message\StreamInterface;
use Http\Client\Exception\HttpException;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Client\Exception\TransferException as HttpTransferException;

use Yproximite\Api\Exception\LogicException;
use Yproximite\Api\Exception\TransferException;
use Yproximite\Api\Exception\AuthenficationException;
use Yproximite\Api\Exception\InvalidResponseException;

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
     *
     * @param HttpClient          $httpClient
     * @param string|null         $apiKey
     * @param string|null         $baseUrl
     * @param MessageFactory|null $messageFactory
     *
     * @throws LogicException
     */
    public function __construct(
        HttpClient $httpClient,
        string $apiKey = null,
        string $baseUrl = null,
        MessageFactory $messageFactory = null
    ) {
        if (empty($baseUrl)) {
            throw new LogicException('The base url cannot be empty.');
        }

        $this->httpClient     = $httpClient;
        $this->messageFactory = $messageFactory;
        $this->apiKey         = $apiKey;
        $this->baseUrl        = $baseUrl;
    }

    /**
     * @param null|string $baseUrl
     */
    public function setBaseUrl(string $baseUrl = null)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param null|string $apiKey
     */
    public function setApiKey(string $apiKey = null)
    {
        $this->apiKey = $apiKey;

        $this->resetApiToken();
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
        $uri  = $this->getSafeBaseUrl();
        $uri .= $path;

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
     * @return string
     */
    private function getSafeBaseUrl(): string
    {
        return !is_null($this->baseUrl) ? $this->baseUrl : self::BASE_URL;
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
        } catch (TransferException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() === 401 && !$this->apiTokenFresh) {
                $this->resetApiToken();

                $content = $this->doSendRequest($method, $uri, $body);
            } else {
                throw $e;
            }
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
        $headers = [];

        if ($withAuthorization) {
            $headers['Authorization'] = $this->getAuthorizationHeader();
        }

        $request = $this->getMessageFactory()->createRequest($method, $uri, $headers, $body);

        try {
            $response = $this->getHttpClient()->sendRequest($request);
        } catch (HttpTransferException $e) {
            throw new TransferException(
                $e->getMessage(),
                $request,
                $e instanceof HttpException ? $e->getResponse() : null
            );
        }

        return (string) $response->getBody();
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
     * Returns all methods that uses query string to transfer a request data
     *
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
        } else {
            $this->updateApiToken();
        }

        return $this->apiToken;
    }

    private function updateApiToken()
    {
        if (is_null($this->apiKey)) {
            throw new LogicException('The api key cannot be empty.');
        }

        try {
            $data = $this->sendRequest('POST', '/login_check', ['api_key' => $this->apiKey], false);
        } catch (TransferException $e) {
            throw new AuthenficationException('Could not request a token.');
        }

        if (!is_array($data) || !array_key_exists('token', $data)) {
            throw new AuthenficationException('Could not retreive a token.');
        }

        $this->apiToken = (string) $data['token'];
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
