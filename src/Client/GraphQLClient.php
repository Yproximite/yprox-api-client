<?php

declare(strict_types=1);

namespace Yproximite\Api\Client;

use GuzzleHttp\Psr7\MultipartStream;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Psr\Http\Message\StreamInterface;
use Yproximite\Api\Exception\AuthenticationException;
use Yproximite\Api\Exception\UploadEmptyFilesException;
use Yproximite\Api\Response;
use Yproximite\Api\Util\UploadFile;

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

    /**
     * @throws \Http\Client\Exception
     */
    public function query(string $query, array $variables = []): Response
    {
        return $this->doGraphQLRequest($query, $variables);
    }

    /**
     * @throws \Http\Client\Exception
     */
    public function mutation(string $query, array $variables = []): Response
    {
        return $this->doGraphQLRequest($query, $variables);
    }

    /**
     * @throws UploadEmptyFilesException
     */
    public function upload(int $siteId, array $files = []): Response
    {
        $normalizedFiles = [];

        if (0 === \count($files)) {
            throw new UploadEmptyFilesException();
        }

        foreach ($files as $k => $file) {
            $normalizedFiles[] = new UploadFile($file);
        }

        // @TODO: Implement upload mutation
        return $this->doGraphQLRequest('upload ...', ['siteId' => $siteId], $normalizedFiles);
    }

    /**
     * @param $files UploadFile[]
     *
     * @throws \Http\Client\Exception
     */
    private function doGraphQLRequest(string $query, array $variables = [], array $files = [], string $filesParameterName = 'medias[]'): Response
    {
        $this->authClient->auth();

        $headers = $this->computeRequestHeaders();
        $body    = $this->computeRequestBody($query, $variables, $files, $filesParameterName);

        $request = $this->createRequest('POST', $this->graphqlEndpoint, $headers, $body);

        try {
            $response = $this->sendRequest($request);
            $contents = $this->extractJson($request, $response);
        } catch (AuthenticationException $e) {
            $this->authClient->auth(true);
            try {
                $response = $this->sendRequest($request);
                $contents = $this->extractJson($request, $response);
            } catch (AuthenticationException $e) {
                throw $e;
            }
        }

        return new Response($contents);
    }

    private function computeRequestHeaders(): array
    {
        $headers = ['Accept' => '*/*'];

        if ($this->authClient->isAuthenticated()) {
            $headers['Authorization'] = sprintf('Bearer %s', $this->authClient->getApiToken());
        }

        return $headers;
    }

    private function computeRequestBody(string $query, array $variables = [], array $files = [], string $filesParameterName = 'medias[]'): StreamInterface
    {
        $data = [
            ['name' => 'query', 'contents' => $query],
            ['name' => 'variables', 'contents' => json_encode($variables)],
        ];

        foreach ($files as $file) {
            $data[] = [
                'name'     => $filesParameterName,
                'contents' => $file->getContent(),
                'filename' => $file->getName(),
            ];
        }

        return new MultipartStream($data);
    }
}
