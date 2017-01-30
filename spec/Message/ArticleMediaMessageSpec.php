<?php

namespace spec\Yproximite\Api\Message;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\ArticleMediaMessage;

class ArticleMediaMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArticleMediaMessage::class);
    }

    function it_should_build()
    {
        $this->setMediaId(1);
        $this->setDisplayOrder(5);

        $data = [
            'media'        => 1,
            'displayOrder' => 5,
        ];

        $this->build()->shouldReturn($data);
    }
}
