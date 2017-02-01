<?php

namespace spec\Yproximite\Api\Model\User;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\User\User;

class UserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    function let()
    {
        $data = [
            'id'        => '1',
            'firstName' => 'Example',
            'lastName'  => '',
            'email'     => 'mail@example.com',
            'company'   => '6',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(1);
        $this->getFirstName()->shouldReturn('Example');
        $this->getLastName()->shouldReturn('');
        $this->getEmail()->shouldReturn('mail@example.com');
        $this->getCompanyId()->shouldReturn(6);
    }
}
