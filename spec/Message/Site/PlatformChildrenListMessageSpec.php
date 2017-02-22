<?php

namespace spec\Yproximite\Api\Message\Site;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Site\PlatformChildrenListMessage;

class PlatformChildrenListMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PlatformChildrenListMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn(null);
    }
}
