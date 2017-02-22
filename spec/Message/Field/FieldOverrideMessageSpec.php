<?php

namespace spec\Yproximite\Api\Message\Field;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Field\FieldOverrideMessage;

class FieldOverrideMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FieldOverrideMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn(null);
    }
}
