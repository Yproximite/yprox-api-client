<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Model\Location\Location;
use Yproximite\Api\Service\LocationService;
use Yproximite\Api\Message\Location\LocationListMessage;
use Yproximite\Api\Message\Location\LocationPostMessage;
use Yproximite\Api\Message\Location\LocationPatchMessage;
use Yproximite\Api\Message\Location\LocationOverrideMessage;

class LocationServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LocationService::class);
    }

    function let(Client $client, ModelFactory $factory)
    {
        $this->beConstructedWith($client, $factory);
    }

    function it_should_get_locations(
        Client $client,
        ModelFactory $factory,
        LocationListMessage $message
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'GET';
        $path   = 'sites/1/locations';

        $client->sendRequest($method, $path)->willReturn([]);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $factory->createMany(Location::class, [])->willReturn([]);

        $this->getLocations($message);
    }

    function it_should_post_location(
        Client $client,
        ModelFactory $factory,
        LocationPostMessage $message,
        Location $location
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'sites/1/locations';
        $data   = ['api_location' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Location::class, [])->willReturn($location);

        $this->postLocation($message);
    }

    function it_should_patch_location(
        Client $client,
        ModelFactory $factory,
        LocationPatchMessage $message,
        Location $location
    ) {
        $message->getId()->willReturn(2);
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'PATCH';
        $path   = 'sites/1/locations/2';
        $data   = ['api_location' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Location::class, [])->willReturn($location);

        $this->patchLocation($message);
    }

    function it_should_override_location(
        Client $client,
        ModelFactory $factory,
        LocationOverrideMessage $message,
        Location $location
    ) {
        $message->getId()->willReturn(5);
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'GET';
        $path   = 'sites/1/locations/5/override';

        $client->sendRequest($method, $path)->willReturn([]);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $factory->create(Location::class, [])->willReturn($location);

        $this->overrideLocation($message);
    }
}
