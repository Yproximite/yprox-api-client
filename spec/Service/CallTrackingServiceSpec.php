<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Model\CallTracking\CallTracking;
use Yproximite\Api\Service\CallTrackingService;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Message\CallTracking\CallTrackingPostMessage;
use Yproximite\Api\Message\CallTracking\CallTrackingPatchMessage;

class CallTrackingServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CallTrackingService::class);
    }

    function let(Client $client, ModelFactory $factory)
    {
        $this->beConstructedWith($client, $factory);
    }

    function it_should_post_call_tracking(
        Client $client,
        ModelFactory $factory,
        CallTrackingPostMessage $message,
        CallTracking $callTracking
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'sites/1/call_trackings';
        $data   = ['api_call_tracking' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(CallTracking::class, [])->willReturn($callTracking);

        $this->postCallTracking($message);
    }

    function it_should_patch_call_tracking(
        Client $client,
        ModelFactory $factory,
        CallTrackingPatchMessage $message,
        CallTracking $callTracking
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'PATCH';
        $path   = 'sites/1/call_trackings/update';
        $data   = ['api_call_tracking_edit' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(CallTracking::class, [])->willReturn($callTracking);

        $this->patchCallTracking($message);
    }
}
