<?php

namespace spec\Yproximite\Api\Model\Site;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Site\SiteRoute;

class SiteRouteSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SiteRoute::class);
    }

    function let()
    {
        $data = [
            'locale' => 'en',
            'path'   => 'simple-route-path',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getLocale()->shouldReturn('en');
        $this->getPath()->shouldReturn('simple-route-path');
    }
}
