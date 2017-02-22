<?php

namespace spec\Yproximite\Api\Message\Location;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Location\LocationListMessage;

class LocationListMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LocationListMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn(null);
    }
}
