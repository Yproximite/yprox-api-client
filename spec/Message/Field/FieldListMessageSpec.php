<?php

namespace spec\Yproximite\Api\Message\Field;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Field\FieldListMessage;

class FieldListMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FieldListMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn(null);
    }
}
