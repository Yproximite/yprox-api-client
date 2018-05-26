<?php

namespace spec\Yproximite\Api\Client;

use GuzzleHttp\Psr7\MultipartStream;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Yproximite\Api\Client\AuthClient;
use Yproximite\Api\Client\GraphQLClient;
use Yproximite\Api\Exception\UploadEmptyFilesException;

class GraphQLClientSpec extends ObjectBehavior
{
    const GRAPHQL_ENDPOINT = 'https://graphql.yproximite.fr';

    public function it_is_initializable()
    {
        $this->shouldHaveType(GraphQLClient::class);
    }

    public function let(HttpClient $httpClient, AuthClient $authClient, MessageFactory $messageFactory)
    {
        $this->beConstructedWith($authClient, self::GRAPHQL_ENDPOINT, $httpClient, $messageFactory);
    }

    public function it_should_send_auth_request_before_graphql_request()
    {
    }

    public function it_should_handle_case_where_api_token_is_invalid()
    {
    }

    public function it_should_handle_case_auth_response_returns_401()
    {
    }

    public function it_should_handle_case_auth_response_is_invalid_json()
    {
    }

    public function it_should_send_graphql_query()
    {
    }

    public function it_should_handle_case_when_graphql_query_returns_errors()
    {
    }

    public function it_should_handle_case_when_graphql_query_returns_warnings()
    {
    }

    public function it_should_send_graphql_mutation()
    {
    }

    public function it_should_handle_case_when_mutation_query_returns_errors()
    {
    }

    public function it_should_handle_case_when_mutation_query_returns_warnings()
    {
    }

    public function it_should_upload_files(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        RequestInterface $request,
        ResponseInterface $response,
        StreamInterface $stream,
        AuthClient $authClient
    ) {
        $authClient->getApiToken()->willReturn('<api token>')->shouldBeCalled();
        $authClient->isAuthenticated()->willReturn(true)->shouldBeCalled();
        $authClient->auth()->shouldBeCalled();

        $messageFactory->createRequest('POST', self::GRAPHQL_ENDPOINT, Argument::type('array'), Argument::type(MultipartStream::class))->willReturn($request);
        $httpClient->sendRequest($request)->willReturn($response);
        $response->getStatusCode()->willReturn(200);
        $response->getBody()->willReturn($stream);
        $stream->__toString()->willReturn(json_encode([
            'data' => [
                'uploadMedias' => [
                    ['id' => 1, 'name' => 'Logo Yprox-1.png', 'fullpathFilename' => 'https://example.com/media/original/Logo Yprox-1.png'],
                    ['id' => 2, 'name' => 'GraphQL-2.png', 'fullpathFilename' => 'https://example.com/media/original/GraphQL-2.png'],
                ],
            ],
        ]));

        $response = $this->upload(123, [
            ['path' => __DIR__.'/../fixtures/Yproximite.png', 'name' => 'Logo Yprox.png'],
            __DIR__.'/../fixtures/GraphQL.png',
        ]);

        $response->hasErrors()->shouldBe(false);
        $response->hasWarnings()->shouldBe(false);
        $response->getData()->shouldBeLike((object) [
            'uploadMedias' => [
                ['id' => 1, 'name' => 'Logo Yprox-1.png', 'fullpathFilename' => 'https://example.com/media/original/Logo Yprox-1.png'],
                ['id' => 2, 'name' => 'GraphQL-2.png', 'fullpathFilename' => 'https://example.com/media/original/GraphQL-2.png'],
            ],
        ]);
    }

    public function it_should_handle_case_when_uploading_empty_files()
    {
        $this->shouldThrow(UploadEmptyFilesException::class)->during('upload', [123]);
    }

    public function it_should_handle_case_when_uploading_is_failing()
    {
    }
}
