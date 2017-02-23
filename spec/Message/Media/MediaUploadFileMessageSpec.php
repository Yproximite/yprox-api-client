<?php

namespace spec\Yproximite\Api\Message\Media;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Media\MediaUploadFileMessage;

class MediaUploadFileMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MediaUploadFileMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn(null);
    }
}
