<?php

namespace spec\Yproximite\Api\Message\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Media\Media;
use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Model\Article\Category;
use Yproximite\Api\Model\Article\ArticleMedia;
use Yproximite\Api\Model\Article\ArticleTranslation;
use Yproximite\Api\Message\Article\ArticleMediaMessage;
use Yproximite\Api\Message\Article\ArticlePatchMessage;
use Yproximite\Api\Message\Article\ArticleTranslationMessage;

class ArticlePatchMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArticlePatchMessage::class);
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

    function it_should_create_from_article(
        Article $article,
        Category $category,
        ArticleTranslation $translation,
        Media $media,
        ArticleMedia $articleMedia
    ) {
        $category->getId()->willReturn(1);

        $translation->getLocale()->willReturn('en');
        $translation->getTitle()->willReturn('English title');
        $translation->getBody()->willReturn('English content');

        $media->getId()->willReturn(1);

        $articleMedia->getMedia()->willReturn($media);
        $articleMedia->getDisplayOrder()->willReturn(10);

        $article->getId()->willReturn(3);
        $article->getCategories()->willReturn([$category]);
        $article->getTranslations()->willReturn([$translation]);
        $article->getMedias()->willReturn([$articleMedia]);
        $article->getStatus()->willReturn(Article::STATUS_PUBLISHED);
        $article->getMediaLimit()->willReturn(5);
        $article->isShareOnFacebook()->willReturn(true);

        $transMessage = new ArticleTranslationMessage();
        $transMessage->setLocale('en');
        $transMessage->setTitle('English title');
        $transMessage->setBody('English content');

        $mediaMessage = new ArticleMediaMessage();
        $mediaMessage->setMediaId(1);
        $mediaMessage->setDisplayOrder(10);

        $message = new ArticlePatchMessage();
        $message->setId(3);
        $message->setStatus(Article::STATUS_PUBLISHED);
        $message->setMediaLimit(5);
        $message->setShareOnFacebook(true);
        $message->setCategoryIds([1]);
        $message->addTranslation($transMessage);
        $message->addMedia($mediaMessage);

        $this::createFromArticle($article)->shouldBeLike($message);
    }
}
