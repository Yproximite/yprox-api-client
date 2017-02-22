<?php

namespace spec\Yproximite\Api\Message\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Article\ArticleListMessage;

class ArticleListMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArticleListMessage::class);
    }

    function it_should_build()
    {
        $this->build()->shouldReturn(null);
    }
}
