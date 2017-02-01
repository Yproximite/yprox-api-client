<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Service\ArticleService;
use Yproximite\Api\Message\Article\ArticlePostMessage;
use Yproximite\Api\Message\Article\ArticlePatchMessage;
use Yproximite\Api\Message\Article\ArticleUnpublishMessage;

class ArticleServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArticleService::class);
    }

    function let(Client $client, ModelFactory $factory)
    {
        $this->beConstructedWith($client, $factory);
    }

    function it_should_post_article(
        Client $client,
        ModelFactory $factory,
        ArticlePostMessage $message,
        Article $article
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'sites/1/articles';
        $data   = ['api_article' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Article::class, [])->willReturn($article);

        $this->postArticle($message);
    }

    function it_should_patch_article(
        Client $client,
        ModelFactory $factory,
        ArticlePatchMessage $message,
        Article $article
    ) {
        $message->getId()->willReturn(2);
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'PATCH';
        $path   = 'sites/1/articles/2';
        $data   = ['api_article' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Article::class, [])->willReturn($article);

        $this->patchArticle($message);
    }

    function it_should_unpublish_articles(
        Client $client,
        ModelFactory $factory,
        ArticleUnpublishMessage $message
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'sites/1/articles/unpublish';
        $data   = ['api_unpublish_articles_global' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->createMany(Article::class, [])->willReturn([]);

        $this->unpublishArticles($message);
    }
}
