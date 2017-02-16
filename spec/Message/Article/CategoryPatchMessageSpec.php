<?php

namespace spec\Yproximite\Api\Message\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Article\Category;
use Yproximite\Api\Model\Article\CategoryTranslation;
use Yproximite\Api\Message\Article\CategoryPatchMessage;
use Yproximite\Api\Message\Article\CategoryTranslationMessage;

class CategoryPatchMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CategoryPatchMessage::class);
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

    function it_should_create_from_category(
        Category $category,
        CategoryTranslation $translation
    ) {
        $translation->getLocale()->willReturn('en');
        $translation->getTitle()->willReturn('English title');
        $translation->getDescription()->willReturn('English description');

        $category->getId()->willReturn(1);
        $category->isEnabled()->willReturn(true);
        $category->getTranslations()->willReturn([$translation]);

        $transMessage = new CategoryTranslationMessage();
        $transMessage->setLocale('en');
        $transMessage->setTitle('English title');
        $transMessage->setDescription('English description');

        $message = new CategoryPatchMessage();
        $message->setId(1);
        $message->setEnabled(true);
        $message->addTranslation($transMessage);

        $this::createFromCategory($category)->shouldBeLike($message);
    }
}
