<?php

namespace spec\Yproximite\Api\Model\TeamWorker;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\TeamWorker\TeamWorker;

class TeamWorkerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TeamWorker::class);
    }

    function let()
    {
        $data = [
            'id'        => '1',
            'lastName'  => 'Bob',
            'firstName' => 'Morane',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(1);
        $this->getLastName()->shouldReturn('Bob');
        $this->getFirstName()->shouldReturn('Morane');
    }
}
