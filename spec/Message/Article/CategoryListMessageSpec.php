<?php

namespace spec\Yproximite\Api\Message\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Article\CategoryListMessage;

class CategoryListMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CategoryListMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn([]);
    }
}
