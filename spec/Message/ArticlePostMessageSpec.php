<?php

namespace spec\Yproximite\Api\Message;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Message\ArticlePostMessage;
use Yproximite\Api\Message\ArticleMediaMessage;
use Yproximite\Api\Message\ArticleTranslationMessage;

class ArticlePostMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArticlePostMessage::class);
    }

    function it_should_build()
    {
        $translation = new ArticleTranslationMessage();
        $translation->setLocale('en');
        $translation->setTitle('English title');
        $translation->setBody('English content');

        $media = new ArticleMediaMessage();
        $media->setMediaId(1);
        $media->setDisplayOrder(5);

        $this->setStatus(Article::STATUS_PUBLISHED);
        $this->setCategoryIds([1, 2]);
        $this->setMediaLimit(5);
        $this->setShareOnFacebook(true);
        $this->addTranslation($translation);
        $this->addMedia($media);

        $translationData = [
            'title' => 'English title',
            'body'  => 'English content',
        ];

        $mediaData = [
            'media'        => 1,
            'displayOrder' => 5,
        ];

        $data = [
            'translations'    => ['en' => $translationData],
            'status'          => 'published',
            'categories'      => [1, 2],
            'articleMedias'   => [$mediaData],
            'mediaLimit'      => 5,
            'shareOnFacebook' => true,
        ];

        $this->build()->shouldReturn($data);
    }
}
