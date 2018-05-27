<?php

namespace spec\Yproximite\Api\Client;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Yproximite\Api\Client\AuthClient;
use Yproximite\Api\Exception\AuthenticationException;
use Yproximite\Api\Exception\InvalidResponseException;

class AuthClientSpec extends ObjectBehavior
{
    const LOGIN_ENDPOINT = 'https://api.yproximite.fr/login_check';

    public function it_is_initializable()
    {
        $this->shouldHaveType(AuthClient::class);
    }

    public function let(HttpClient $httpClient, MessageFactory $messageFactory)
    {
        $this->beConstructedWith('<api key>', self::LOGIN_ENDPOINT, $httpClient, $messageFactory);
    }

    public function it_should_authenticate_user(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        RequestInterface $tokenRequest,
        ResponseInterface $tokenResponse,
        StreamInterface $tokenStream
    ) {
        $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
        $body    = http_build_query(['api_key' => '<api key>']);

        $messageFactory->createRequest('POST', self::LOGIN_ENDPOINT, $headers, $body)->willReturn($tokenRequest);
        $httpClient->sendRequest($tokenRequest)->willReturn($tokenResponse);
        $tokenResponse->getStatusCode()->willReturn(200);
        $tokenResponse->getBody()->willReturn($tokenStream);
        $tokenStream->__toString()->willReturn('{"token": "<jwt_token>"}');

        $this->auth();
        $this->getApiToken()->shouldReturn('<jwt_token>');
        $this->isAuthenticated()->shouldReturn(true);
    }

    public function it_should_throw_authentication_exception_if_api_key_is_invalid(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        RequestInterface $tokenRequest,
        ResponseInterface $tokenResponse,
        StreamInterface $tokenStream
    ) {
        $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
        $body    = http_build_query(['api_key' => '<api key>']);

        $messageFactory->createRequest('POST', self::LOGIN_ENDPOINT, $headers, $body)->willReturn($tokenRequest);
        $httpClient->sendRequest($tokenRequest)->willReturn($tokenResponse);
        $tokenResponse->getStatusCode()->willReturn(401);
        $tokenResponse->getBody()->willReturn($tokenStream);
        $tokenStream->__toString()->willReturn('{"message": "Bad credentials", "code": 401}');

        $this->shouldThrow(AuthenticationException::class)->during('auth');
        $this->getApiToken()->shouldBeNull();
        $this->isAuthenticated()->shouldReturn(false);
    }

    public function it_should_throw_invalid_response_exception_if_invalid_json(
        HttpClient $httpClient,
        MessageFactory $messageFactory,
        RequestInterface $tokenRequest,
        ResponseInterface $tokenResponse,
        StreamInterface $tokenStream
    ) {
        $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];
        $body    = http_build_query(['api_key' => '<api key>']);

        $messageFactory->createRequest('POST', self::LOGIN_ENDPOINT, $headers, $body)->willReturn($tokenRequest);
        $httpClient->sendRequest($tokenRequest)->willReturn($tokenResponse);
        $tokenResponse->getStatusCode()->willReturn(200);
        $tokenResponse->getBody()->willReturn($tokenStream);
        $tokenStream->__toString()->willReturn('{"invalid JSON",}');

        $this->shouldThrow(InvalidResponseException::class)->during('auth');
        $this->getApiToken()->shouldBeNull();
        $this->isAuthenticated()->shouldReturn(false);
    }
}
