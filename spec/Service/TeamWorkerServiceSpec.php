<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Model\TeamWorker\TeamWorker;
use Yproximite\Api\Service\TeamWorkerService;
use Yproximite\Api\Message\TeamWorker\TeamWorkerPostMessage;
use Yproximite\Api\Message\TeamWorker\TeamWorkerPatchMessage;

class TeamWorkerServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TeamWorkerService::class);
    }

    function let(Client $client, ModelFactory $factory)
    {
        $this->beConstructedWith($client, $factory);
    }

    function it_should_post_team_worker(
        Client $client,
        ModelFactory $factory,
        TeamWorkerPostMessage $message,
        TeamWorker $teamWorker
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'sites/1/teams/workers';
        $data   = ['api_team_worker' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(TeamWorker::class, [])->willReturn($teamWorker);

        $this->postTeamWorker($message);
    }

    function it_should_patch_team_worker(
        Client $client,
        ModelFactory $factory,
        TeamWorkerPatchMessage $message,
        TeamWorker $teamWorker
    ) {
        $message->getId()->willReturn(2);
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'PATCH';
        $path   = 'sites/1/teams/2/worker';
        $data   = ['api_team_worker' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(TeamWorker::class, [])->willReturn($teamWorker);

        $this->patchTeamWorker($message);
    }
}
