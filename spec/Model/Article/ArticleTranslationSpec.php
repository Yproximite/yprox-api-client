<?php

namespace spec\Yproximite\Api\Model\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Article\ArticleTranslation;

class ArticleTranslationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArticleTranslation::class);
    }

    function let()
    {
        $data = [
            'locale' => 'en',
            'title'  => 'English translation',
            'body'   => 'Big text',
            'slug'   => 'en-translation',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getLocale()->shouldReturn('en');
        $this->getTitle()->shouldReturn('English translation');
        $this->getBody()->shouldReturn('Big text');
        $this->getSlug()->shouldReturn('en-translation');
    }
}
