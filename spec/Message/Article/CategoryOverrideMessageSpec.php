<?php

namespace spec\Yproximite\Api\Message\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Article\CategoryOverrideMessage;

class CategoryOverrideMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CategoryOverrideMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn(null);
    }
}
