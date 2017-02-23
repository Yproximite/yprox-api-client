<?php

namespace spec\Yproximite\Api\Message\Media;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Media\MediaDynamicUrlMessage;

class MediaDynamicUrlMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MediaDynamicUrlMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn(null);
    }
}
