<?php

namespace spec\Yproximite\Api\Client;

use Http\Client\HttpClient;
use PhpSpec\ObjectBehavior;
use Http\Message\MessageFactory;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Http\Client\Exception\HttpException;
use Http\Discovery\MessageFactoryDiscovery;

use Yproximite\Api\Client\Client;

class ClientSpec extends ObjectBehavior
{
    const API_KEY  = 'abcd';
    const BASE_URL = 'http://api.host';

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }

    function let(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        RequestInterface $tokenRequest,
        ResponseInterface $tokenResponse,
        StreamInterface $tokenStream
    ) {
        $tokenRequestUri  = sprintf('%s/login_check', self::BASE_URL);
        $tokenRawRequest  = http_build_query(['api_key' => self::API_KEY]);
        $tokenRawResponse = json_encode(['token' => 'efgh']);

        $messageFactory->createRequest('POST', $tokenRequestUri, [], $tokenRawRequest)->willReturn($tokenRequest);
        $httpClient->sendRequest($tokenRequest)->willReturn($tokenResponse);
        $tokenResponse->getStatusCode()->willReturn(200);
        $tokenResponse->getBody()->willReturn($tokenStream);
        $tokenStream->__toString()->willReturn($tokenRawResponse);

        $this->beConstructedWith($httpClient, self::API_KEY, self::BASE_URL, $messageFactory);
    }

    function it_should_send_get_request(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        RequestInterface $request,
        ResponseInterface $response,
        StreamInterface $stream
    ) {
        $rawQuery    = http_build_query(['query' => 'test']);
        $requestUri  = sprintf('%s/example?%s', self::BASE_URL, $rawQuery);
        $rawResponse = json_encode(['foo' => 'bar']);

        $messageFactory->createRequest('GET', $requestUri, ['Authorization' => 'Bearer efgh'], null)->willReturn($request);
        $httpClient->sendRequest($request)->willReturn($response);
        $response->getStatusCode()->willReturn(200);
        $response->getBody()->willReturn($stream);
        $stream->__toString()->willReturn($rawResponse);

        $httpClient->sendRequest($request)->shouldBeCalled();

        $this->sendRequest('GET', '/example', ['query' => 'test']);
    }

    function it_should_send_post_request(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        RequestInterface $request,
        ResponseInterface $response,
        StreamInterface $stream
    ) {
        $requestUri  = sprintf('%s/example', self::BASE_URL);
        $rawRequest  = http_build_query(['query' => 'test']);
        $rawResponse = json_encode(['foo' => 'bar']);

        $messageFactory->createRequest('POST', $requestUri, ['Authorization' => 'Bearer efgh'], $rawRequest)->willReturn($request);
        $httpClient->sendRequest($request)->willReturn($response);
        $response->getStatusCode()->willReturn(200);
        $response->getBody()->willReturn($stream);
        $stream->__toString()->willReturn($rawResponse);

        $httpClient->sendRequest($request)->shouldBeCalled();

        $this->sendRequest('POST', '/example', ['query' => 'test']);
    }

    function it_should_ask_for_api_token_once(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        RequestInterface $firstRequest,
        ResponseInterface $firstResponse,
        StreamInterface $firstStream,
        RequestInterface $secondRequest,
        ResponseInterface $secondResponse,
        StreamInterface $secondStream,
        RequestInterface $tokenRequest
    ) {
        // first request
        $firstRequestUri  = sprintf('%s/first', self::BASE_URL);
        $firstRawResponse = json_encode(['foo' => 'bar']);

        $messageFactory->createRequest('GET', $firstRequestUri, ['Authorization' => 'Bearer efgh'], null)->willReturn($firstRequest);
        $httpClient->sendRequest($firstRequest)->willReturn($firstResponse);
        $firstResponse->getStatusCode()->willReturn(200);
        $firstResponse->getBody()->willReturn($firstStream);
        $firstStream->__toString()->willReturn($firstRawResponse);

        $httpClient->sendRequest($firstRequest)->shouldBeCalled();

        $this->sendRequest('GET', '/first');

        // second request
        $secondRequestUri  = sprintf('%s/second', self::BASE_URL);
        $secondRawResponse = json_encode(['foo' => 'bar']);

        $messageFactory->createRequest('GET', $secondRequestUri, ['Authorization' => 'Bearer efgh'], null)->willReturn($secondRequest);
        $httpClient->sendRequest($secondRequest)->willReturn($secondResponse);
        $secondResponse->getStatusCode()->willReturn(200);
        $secondResponse->getBody()->willReturn($secondStream);
        $secondStream->__toString()->willReturn($secondRawResponse);

        $httpClient->sendRequest($secondRequest)->shouldBeCalled();

        $this->sendRequest('GET', '/second');

        $httpClient->sendRequest($tokenRequest)->shouldHaveBeenCalledTimes(1);
    }

    function it_should_renew_the_token_and_resend_the_request(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        RequestInterface $firstRequest,
        ResponseInterface $firstResponse,
        StreamInterface $firstStream,
        RequestInterface $secondRequest,
        ResponseInterface $secondResponse,
        StreamInterface $secondStream,
        RequestInterface $tokenRequest
    ) {
        // first request
        $firstRequestUri  = sprintf('%s/first', self::BASE_URL);
        $firstRawResponse = json_encode(['foo' => 'bar']);

        $messageFactory->createRequest('GET', $firstRequestUri, ['Authorization' => 'Bearer efgh'], null)->willReturn($firstRequest);
        $httpClient->sendRequest($firstRequest)->willReturn($firstResponse);
        $firstResponse->getStatusCode()->willReturn(200);
        $firstResponse->getBody()->willReturn($firstStream);
        $firstStream->__toString()->willReturn($firstRawResponse);

        $httpClient->sendRequest($firstRequest)->shouldBeCalled();

        $this->sendRequest('GET', '/first');

        // second request
        $secondRequestUri  = sprintf('%s/second', self::BASE_URL);
        $secondRawResponse = json_encode(['foo' => 'bar']);

        $messageFactory->createRequest('GET', $secondRequestUri, ['Authorization' => 'Bearer efgh'], null)->willReturn($secondRequest);
        $secondResponse->getStatusCode()->willReturn(200);
        $secondResponse->getBody()->willReturn($secondStream);
        $secondStream->__toString()->willReturn($secondRawResponse);

        $secondRequestCounter = 0;

        $httpClient->sendRequest($secondRequest)->will(function ($args) use ($secondRequestCounter, $secondResponse) {
            $secondRequestCounter ++;

            if ($secondRequestCounter === 1) {
                $errorResponse = MessageFactoryDiscovery::find()->createResponse(401);

                throw HttpException::create($args[0], $errorResponse);
            }

            return $secondResponse;
        });

        $httpClient->sendRequest($secondRequest)->shouldBeCalledTimes(2);

        $this->shouldThrow(HttpException::class)->during('sendRequest', ['GET', '/second']);

        $httpClient->sendRequest($tokenRequest)->shouldHaveBeenCalledTimes(2);
    }

    function it_should_not_renew_the_token(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        RequestInterface $request,
        ResponseInterface $response,
        StreamInterface $stream,
        RequestInterface $tokenRequest
    ) {
        $requestUri  = sprintf('%s/example', self::BASE_URL);
        $rawResponse = json_encode(['foo' => 'bar']);

        $messageFactory->createRequest('GET', $requestUri, ['Authorization' => 'Bearer efgh'], null)->willReturn($request);
        $response->getStatusCode()->willReturn(200);
        $response->getBody()->willReturn($stream);
        $stream->__toString()->willReturn($rawResponse);

        $httpClient->sendRequest($request)->will(function ($args) {
            $errorResponse = MessageFactoryDiscovery::find()->createResponse(401);

            throw HttpException::create($args[0], $errorResponse);
        });

        $httpClient->sendRequest($request)->shouldBeCalled();

        $this->shouldThrow(HttpException::class)->during('sendRequest', ['GET', '/example']);

        $httpClient->sendRequest($tokenRequest)->shouldHaveBeenCalledTimes(1);
    }
}
