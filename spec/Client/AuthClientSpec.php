<?php

namespace spec\Yproximite\Api\Client;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Yproximite\Api\Client\AuthClient;
use Yproximite\Api\Exception\AuthenticationException;

class AuthClientSpec extends ObjectBehavior
{
    const LOGIN_ENDPOINT = 'https://api.yproximite.fr/login_check';

    function it_is_initializable()
    {
        $this->shouldHaveType(AuthClient::class);
    }

    function let(HttpClient $httpClient, MessageFactory $messageFactory)
    {
        $this->beConstructedWith('<api key>', self::LOGIN_ENDPOINT, $httpClient, $messageFactory);
    }

    function it_should_throw_authentication_exception_if_api_key_is_invalid()
    {
        $this->shouldThrow(AuthenticationException::class)->during('auth');
        $this->isAuthenticated()->shouldReturn(false);
    }

    function it_should_throw_authentication_exception_if_response_is_invalid_json()
    {
        $this->shouldThrow(AuthenticationException::class)->during('auth');
        $this->isAuthenticated()->shouldReturn(false);
    }

    function it_should_auth_if_api_key_is_valid(MessageFactory $messageFactory, RequestInterface $request)
    {
        $messageFactory->createRequest('POST', self::LOGIN_ENDPOINT, ['api_key' => '<api key>'])->willReturn($request);

        $this->auth();
        $this->isAuthenticated()->shouldReturn(true);
    }
}
