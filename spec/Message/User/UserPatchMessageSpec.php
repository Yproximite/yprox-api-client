<?php

namespace spec\Yproximite\Api\Message\User;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\User\User;
use Yproximite\Api\Message\User\UserPatchMessage;

class UserPatchMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UserPatchMessage::class);
    }

    function it_should_build()
    {
        $this->setFirstName('Example');
        $this->setLastName('');
        $this->setEmail('mail@example.com');
        $this->setPlainPassword('12345');
        $this->setPhone('+1 234 567 890');
        $this->setDefaultLocale('en');

        $data = [
            'firstName'     => 'Example',
            'lastName'      => '',
            'email'         => 'mail@example.com',
            'plainPassword' => '12345',
            'phone'         => '+1 234 567 890',
            'defaultLocale' => 'en',
        ];

        $this->build()->shouldReturn($data);
    }

    function it_should_create_from_user(User $user)
    {
        $user->getId()->willReturn(1);
        $user->getFirstName()->willReturn('Example');
        $user->getLastName()->willReturn('');
        $user->getEmail()->willReturn('mail@example.com');
        $user->getCompanyId()->willReturn(2);

        $message = new UserPatchMessage();
        $message->setId(1);
        $message->setFirstName('Example');
        $message->setLastName('');
        $message->setEmail('mail@example.com');
        $message->setCompanyId(2);

        $this::createFromUser($user)->shouldBeLike($message);
    }
}
