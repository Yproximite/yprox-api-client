<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Model\Article\Category;
use Yproximite\Api\Service\ArticleService;
use Yproximite\Api\Message\Article\ArticleListMessage;
use Yproximite\Api\Message\Article\ArticlePostMessage;
use Yproximite\Api\Message\Article\ArticlePatchMessage;
use Yproximite\Api\Message\Article\CategoryListMessage;
use Yproximite\Api\Message\Article\ArticleUnpublishMessage;
use Yproximite\Api\Message\Article\CategoryOverrideMessage;
use Yproximite\Api\Message\Article\CategoryArticlePublishMessage;
use Yproximite\Api\Message\Article\CategoryArticleUnpublishMessage;

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

    function it_should_get_articles(
        Client $client,
        ModelFactory $factory,
        ArticleListMessage $message
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'GET';
        $path   = 'sites/1/articles';

        $client->sendRequest($method, $path)->willReturn([]);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $factory->createMany(Article::class, [])->willReturn([]);

        $this->getArticles($message);
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

    function it_should_get_categories(
        Client $client,
        ModelFactory $factory,
        CategoryListMessage $message
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'GET';
        $path   = 'sites/1/categories';

        $client->sendRequest($method, $path)->willReturn([]);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $factory->createMany(Category::class, [])->willReturn([]);

        $this->getCategories($message);
    }

    function it_should_override_category(
        Client $client,
        ModelFactory $factory,
        CategoryOverrideMessage $message,
        Category $category
    ) {
        $message->getId()->willReturn(5);
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'GET';
        $path   = 'sites/1/categories/5/override';

        $client->sendRequest($method, $path)->willReturn([]);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $factory->create(Category::class, [])->willReturn($category);

        $this->overrideCategory($message);
    }

    function it_should_publish_category_articles(
        Client $client,
        ModelFactory $factory,
        CategoryArticlePublishMessage $message,
        Category $category
    ) {
        $message->getSiteId()->willReturn(1);
        $message->getCategoryId()->willReturn(2);
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'sites/1/categories/2/publish_articles';
        $data   = ['api_publish_articles' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Category::class, [])->willReturn($category);

        $this->publishCategoryArticles($message);
    }

    function it_should_unpublish_category_articles(
        Client $client,
        ModelFactory $factory,
        CategoryArticleUnpublishMessage $message,
        Category $category
    ) {
        $message->getSiteId()->willReturn(1);
        $message->getCategoryId()->willReturn(2);
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'sites/1/categories/2/unpublish_articles';
        $data   = ['api_unpublish_articles' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Category::class, [])->willReturn($category);

        $this->unpublishCategoryArticles($message);
    }
}
