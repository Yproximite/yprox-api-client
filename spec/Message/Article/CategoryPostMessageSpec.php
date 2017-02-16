<?php

namespace spec\Yproximite\Api\Message\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Article\CategoryPostMessage;
use Yproximite\Api\Message\Article\CategoryTranslationMessage;

class CategoryPostMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CategoryPostMessage::class);
    }

    function it_should_build()
    {
        $translation = new CategoryTranslationMessage();
        $translation->setLocale('en');
        $translation->setTitle('English title');
        $translation->setDescription('English description');

        $this->setParentRootId(11);
        $this->setEnabled(true);
        $this->addTranslation($translation);

        $transData = [
            'title'       => 'English title',
            'description' => 'English description',
        ];

        $data = [
            'parentRootId' => 11,
            'enabled'      => true,
            'translations' => ['en' => $transData],
        ];

        $this->build()->shouldReturn($data);
    }
}
