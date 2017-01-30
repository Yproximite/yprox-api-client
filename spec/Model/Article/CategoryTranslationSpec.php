<?php

namespace spec\Yproximite\Api\Model\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Article\CategoryTranslation;

class CategoryTranslationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CategoryTranslation::class);
    }

    function let()
    {
        $data = [
            'locale'      => 'en',
            'title'       => 'English translation',
            'description' => 'Big text',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getLocale()->shouldReturn('en');
        $this->getTitle()->shouldReturn('English translation');
        $this->getDescription()->shouldReturn('Big text');
    }
}
