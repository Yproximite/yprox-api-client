<?php

namespace spec\Yproximite\Api\Message\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Article\ArticleUnpublishMessage;

class ArticleUnpublishMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArticleUnpublishMessage::class);
    }

    function it_should_build()
    {
        $this->setArticleIds([1, 2]);

        $data = [
            'articles' => [1, 2],
        ];

        $this->build()->shouldReturn($data);
    }
}
