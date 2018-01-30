<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Message\Article\ArticleOverrideMessage;
use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Model\Article\Category;
use Yproximite\Api\Message\Article\ArticleListMessage;
use Yproximite\Api\Message\Article\ArticlePostMessage;
use Yproximite\Api\Message\Article\ArticlePatchMessage;
use Yproximite\Api\Message\Article\CategoryListMessage;
use Yproximite\Api\Message\Article\CategoryPostMessage;
use Yproximite\Api\Message\Article\CategoryPatchMessage;
use Yproximite\Api\Message\Article\ArticleUnpublishMessage;
use Yproximite\Api\Message\Article\CategoryOverrideMessage;
use Yproximite\Api\Message\Article\CategoryArticleListMessage;
use Yproximite\Api\Message\Article\CategoryArticlePublishMessage;
use Yproximite\Api\Message\Article\CategoryArticleUnpublishMessage;
use Yproximite\Api\Util\RequestStatus;

/**
 * Class ArticleService
 */
class ArticleService extends AbstractService implements ServiceInterface
{
    /**
     * @param ArticleListMessage $message
     *
     * @return Article[]
     */
    public function getArticles(ArticleListMessage $message): array
    {
        $path = sprintf('sites/%d/articles', $message->getSiteId());

        $response = $this->getClient()->sendRequest(RequestStatus::GET, $path);

        /** @var Article[] $models */
        $models = $this->getModelFactory()->createMany(Article::class, $response);

        return $models;
    }

    /**
     * @param ArticlePostMessage $message
     *
     * @return Article
     */
    public function postArticle(ArticlePostMessage $message): Article
    {
        $path = sprintf('sites/%d/articles', $message->getSiteId());
        $data = ['api_article' => $message->build()];

        $response = $this->getClient()->sendRequest(RequestStatus::POST, $path, $data);

        /** @var Article $model */
        $model = $this->getModelFactory()->create(Article::class, $response);

        return $model;
    }

    /**
     * @param ArticlePatchMessage $message
     *
     * @return Article
     */
    public function patchArticle(ArticlePatchMessage $message): Article
    {
        $path = sprintf('sites/%d/articles/%d', $message->getSiteId(), $message->getId());
        $data = ['api_article' => $message->build()];

        $response = $this->getClient()->sendRequest(RequestStatus::PATCH, $path, $data);

        /** @var Article $model */
        $model = $this->getModelFactory()->create(Article::class, $response);

        return $model;
    }

    /**
     * @param ArticleUnpublishMessage $message
     *
     * @return Article[]
     */
    public function unpublishArticles(ArticleUnpublishMessage $message): array
    {
        $path = sprintf('sites/%d/articles/unpublish', $message->getSiteId());
        $data = ['api_unpublish_articles_global' => $message->build()];

        $response = $this->getClient()->sendRequest(RequestStatus::POST, $path, $data);

        /** @var Article[] $models */
        $models = $this->getModelFactory()->createMany(Article::class, $response);

        return $models;
    }

    /**
     * @param CategoryListMessage $message
     *
     * @return Category[]
     */
    public function getCategories(CategoryListMessage $message): array
    {
        $path = sprintf('sites/%d/categories', $message->getSiteId());

        $response = $this->getClient()->sendRequest(RequestStatus::GET, $path);

        /** @var Category[] $models */
        $models = $this->getModelFactory()->createMany(Category::class, $response);

        return $models;
    }

    /**
     * @param CategoryPostMessage $message
     *
     * @return Category
     */
    public function postCategory(CategoryPostMessage $message): Category
    {
        $path = sprintf('sites/%d/categories', $message->getSiteId());
        $data = ['api_category' => $message->build()];

        $response = $this->getClient()->sendRequest(RequestStatus::POST, $path, $data);

        /** @var Category $model */
        $model = $this->getModelFactory()->create(Category::class, $response);

        return $model;
    }

    /**
     * @param CategoryPatchMessage $message
     *
     * @return Category
     */
    public function patchCategory(CategoryPatchMessage $message): Category
    {
        $path = sprintf('sites/%d/categories/%d', $message->getSiteId(), $message->getId());
        $data = ['api_category' => $message->build()];

        $response = $this->getClient()->sendRequest(RequestStatus::PATCH, $path, $data);

        /** @var Category $model */
        $model = $this->getModelFactory()->create(Category::class, $response);

        return $model;
    }

    /**
     * @param CategoryOverrideMessage $message
     *
     * @return Category
     */
    public function overrideCategory(CategoryOverrideMessage $message): Category
    {
        $path = sprintf('sites/%d/categories/%d/override', $message->getSiteId(), $message->getId());

        $response = $this->getClient()->sendRequest(RequestStatus::GET, $path);

        /** @var Category $model */
        $model = $this->getModelFactory()->create(Category::class, $response);

        return $model;
    }

    /**
     * @param CategoryArticleListMessage $message
     *
     * @return Article[]
     */
    public function getCategoryArticles(CategoryArticleListMessage $message): array
    {
        $path = sprintf('sites/%d/categories/%d/articles', $message->getSiteId(), $message->getCategoryId());

        $response = $this->getClient()->sendRequest(RequestStatus::GET, $path);

        /** @var Article[] $models */
        $models = $this->getModelFactory()->createMany(Article::class, $response);

        return $models;
    }

    /**
     * @param CategoryArticlePublishMessage $message
     *
     * @return Category
     */
    public function publishCategoryArticles(CategoryArticlePublishMessage $message): Category
    {
        $path = sprintf('sites/%d/categories/%d/publish_articles', $message->getSiteId(), $message->getCategoryId());
        $data = ['api_publish_articles' => $message->build()];

        $response = $this->getClient()->sendRequest(RequestStatus::POST, $path, $data);

        /** @var Category $model */
        $model = $this->getModelFactory()->create(Category::class, $response);

        return $model;
    }

    /**
     * @param CategoryArticleUnpublishMessage $message
     *
     * @return Category
     */
    public function unpublishCategoryArticles(CategoryArticleUnpublishMessage $message): Category
    {
        $path = sprintf('sites/%d/categories/%d/unpublish_articles', $message->getSiteId(), $message->getCategoryId());
        $data = ['api_unpublish_articles' => $message->build()];

        $response = $this->getClient()->sendRequest(RequestStatus::POST, $path, $data);

        /** @var Category $model */
        $model = $this->getModelFactory()->create(Category::class, $response);

        return $model;
    }

    /**
     * @param ArticleOverrideMessage $message
     *
     * @return Article
     */
    public function overrideArticle(ArticleOverrideMessage $message): Article
    {
        $path = sprintf('sites/%d/articles/%d/override', $message->getSiteId(), $message->getArticleId());

        $response = $this->getClient()->sendRequest(RequestStatus::GET, $path);

        /** @var Article $model */
        $model = $this->getModelFactory()->create(Article::class, $response);

        return $model;
    }
}
