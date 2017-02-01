<?php

namespace spec\Yproximite\Api\Message;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\ArticleTranslationMessage;
use Yproximite\Api\Model\Article\ArticleTranslation;

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

    function it_should_create_from_article_translation(ArticleTranslation $translation)
    {
        $translation->getLocale()->willReturn('en');
        $translation->getTitle()->willReturn('Big title');
        $translation->getBody()->willReturn('Long body');

        $message = new ArticleTranslationMessage();
        $message->setLocale('en');
        $message->setTitle('Big title');
        $message->setBody('Long body');

        $this::createFromArticleTranslation($translation)->shouldBeLike($message);
    }
}
