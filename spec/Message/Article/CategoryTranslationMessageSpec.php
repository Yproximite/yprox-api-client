<?php

namespace spec\Yproximite\Api\Message\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Article\CategoryTranslation;
use Yproximite\Api\Message\Article\CategoryTranslationMessage;

class CategoryTranslationMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CategoryTranslationMessage::class);
    }

    function it_should_build()
    {
        $this->setTitle('Category alpha');
        $this->setDescription('Some information');

        $data = [
            'title'       => 'Category alpha',
            'description' => 'Some information',
        ];

        $this->build()->shouldReturn($data);
    }

    function it_should_create_from_category_translation(CategoryTranslation $translation)
    {
        $translation->getLocale()->willReturn('en');
        $translation->getTitle()->willReturn('Big title');
        $translation->getDescription()->willReturn('Long description');

        $message = new CategoryTranslationMessage();
        $message->setLocale('en');
        $message->setTitle('Big title');
        $message->setDescription('Long description');

        $this::createFromCategoryTranslation($translation)->shouldBeLike($message);
    }
}
