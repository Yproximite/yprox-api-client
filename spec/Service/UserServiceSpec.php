<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Model\User\User;
use Yproximite\Api\Service\UserService;
use Yproximite\Api\Message\User\UserPostMessage;
use Yproximite\Api\Message\User\UserPatchMessage;

class UserServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UserService::class);
    }

    function let(Client $client, ModelFactory $factory)
    {
        $this->beConstructedWith($client, $factory);
    }

    function it_should_post_user(
        Client $client,
        ModelFactory $factory,
        UserPostMessage $message,
        User $user
    ) {
        $message->getCompanyId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'companies/1/users';
        $data   = ['api_user' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(User::class, [])->willReturn($user);

        $this->postUser($message);
    }

    function it_should_patch_user(
        Client $client,
        ModelFactory $factory,
        UserPatchMessage $message,
        User $user
    ) {
        $message->getId()->willReturn(2);
        $message->getCompanyId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'PATCH';
        $path   = 'companies/1/users/2';
        $data   = ['api_user' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(User::class, [])->willReturn($user);

        $this->patchUser($message);
    }
}
