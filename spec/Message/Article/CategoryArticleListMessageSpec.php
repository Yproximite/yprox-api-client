<?php

namespace spec\Yproximite\Api\Message\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Article\CategoryArticleListMessage;

class CategoryArticleListMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CategoryArticleListMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn([]);
    }
}
