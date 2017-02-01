<?php

namespace spec\Yproximite\Api\Message\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Article\CategoryArticlePublishMessage;

class CategoryArticlePublishMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CategoryArticlePublishMessage::class);
    }

    function it_should_build()
    {
        $this->setCategoryId(5);
        $this->setArticleIds([1, 2]);

        $data = [
            'category' => 5,
            'articles' => [1, 2],
        ];

        $this->build()->shouldReturn($data);
    }
}
