<?php

namespace spec\Yproximite\Api\Message\TeamWorker;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\TeamWorker\TeamWorkerPostMessage;

class TeamWorkerPostMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TeamWorkerPostMessage::class);
    }

    function it_should_build()
    {
        $this->setLastName('Bob');
        $this->setFirstName('Morane');

        $data = [
            'lastName'  => 'Bob',
            'firstName' => 'Morane',
        ];

        $this->build()->shouldReturn($data);
    }
}
