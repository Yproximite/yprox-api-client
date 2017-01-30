<?php

namespace spec\Yproximite\Api\Message;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\ArticleTranslationMessage;

class ArticleTranslationMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArticleTranslationMessage::class);
    }

    function it_should_build()
    {
        $this->setTitle('Big title');
        $this->setBody('Long body');

        $data = [
            'title' => 'Big title',
            'body'  => 'Long body',
        ];

        $this->build()->shouldReturn($data);
    }
}
