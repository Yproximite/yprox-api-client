<?php

namespace spec\Yproximite\Api\Message\User;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Exception\LogicException;
use Yproximite\Api\Message\User\UserPostMessage;

class UserPostMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UserPostMessage::class);
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

    function it_should_ask_for_plain_password()
    {
        $this->setFirstName('Example');
        $this->setLastName('');
        $this->setEmail('mail@example.com');
        $this->setPhone('+1 234 567 890');
        $this->setDefaultLocale('en');

        $this->shouldThrow(LogicException::class)->during('build');
    }
}
