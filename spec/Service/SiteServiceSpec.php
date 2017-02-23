<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Model\Site\Site;
use Yproximite\Api\Service\SiteService;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Message\Site\SitePostMessage;
use Yproximite\Api\Message\Site\PlatformChildrenListMessage;

class SiteServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SiteService::class);
    }

    function let(Client $client, ModelFactory $factory)
    {
        $this->beConstructedWith($client, $factory);
    }

    function it_should_get_sites(Client $client, ModelFactory $factory)
    {
        $method = 'GET';
        $path   = 'sites';

        $client->sendRequest($method, $path)->willReturn([]);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $factory->createMany(Site::class, [])->willReturn([]);

        $this->getSites();
    }

    function it_should_get_site(Client $client, ModelFactory $factory, Site $site)
    {
        $method = 'GET';
        $path   = 'sites/1';

        $client->sendRequest($method, $path)->willReturn([]);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $factory->create(Site::class, [])->willReturn($site);

        $this->getSite(1);
    }

    function it_should_post_site(
        Client $client,
        ModelFactory $factory,
        SitePostMessage $message,
        Site $site
    ) {
        $message->getCompanyId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'sites';
        $data   = ['api_site' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Site::class, [])->willReturn($site);

        $this->postSite($message);
    }

    function it_should_get_platform_children(
        Client $client,
        ModelFactory $factory,
        PlatformChildrenListMessage $message
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'GET';
        $path   = 'platform/1/children';

        $client->sendRequest($method, $path)->willReturn([]);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $factory->createMany(Site::class, [])->willReturn([]);

        $this->getPlatformChildren($message);
    }
}
