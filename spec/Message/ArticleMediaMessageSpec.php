<?php

namespace spec\Yproximite\Api\Message;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Media\Media;
use Yproximite\Api\Model\Article\ArticleMedia;
use Yproximite\Api\Message\ArticleMediaMessage;

class ArticleMediaMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArticleMediaMessage::class);
    }

    function it_should_build()
    {
        $this->setMediaId(1);
        $this->setDisplayOrder(5);

        $data = [
            'media'        => 1,
            'displayOrder' => 5,
        ];

        $this->build()->shouldReturn($data);
    }

    function it_should_create_from_article_media(ArticleMedia $articleMedia, Media $media)
    {
        $media->getId()->willReturn(1);

        $articleMedia->getMedia()->willReturn($media);
        $articleMedia->getDisplayOrder()->willReturn(10);

        $message = new ArticleMediaMessage();
        $message->setMediaId(1);
        $message->setDisplayOrder(10);

        $this::createFromArticleMedia($articleMedia)->shouldBeLike($message);
    }
}
