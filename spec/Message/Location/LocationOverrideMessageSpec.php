<?php

namespace spec\Yproximite\Api\Message\Location;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Location\LocationOverrideMessage;

class LocationOverrideMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LocationOverrideMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn(null);
    }
}
