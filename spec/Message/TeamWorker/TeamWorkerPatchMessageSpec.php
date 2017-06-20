<?php

namespace spec\Yproximite\Api\Message\TeamWorker;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\TeamWorker\TeamWorker;
use Yproximite\Api\Message\TeamWorker\TeamWorkerPatchMessage;

class TeamWorkerPatchMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TeamWorkerPatchMessage::class);
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

    function it_should_create_from_team_worker(TeamWorker $teamWorker)
    {
        $teamWorker->getId()->willReturn(1);
        $teamWorker->getLastName()->willReturn('Bob');
        $teamWorker->getFirstName()->willReturn('Morane');

        $message = new TeamWorkerPatchMessage();
        $message->setId(1);
        $message->setLastName('Bob');
        $message->setFirstName('Morane');

        $this::createFromTeamWorker($teamWorker)->shouldBeLike($message);
    }
}
