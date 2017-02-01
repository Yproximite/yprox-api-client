<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Message\Article\ArticlePostMessage;
use Yproximite\Api\Message\Article\ArticlePatchMessage;

/**
 * Class ArticleService
 */
final class ArticleService extends AbstractService implements ServiceInterface
{
    /**
     * @param ArticlePostMessage $message
     *
     * @return Article
     */
    public function postArticle(ArticlePostMessage $message): Article
    {
        $path = sprintf('sites/%d/articles', $message->getSiteId());
        $data = ['api_article' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

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

        $response = $this->getClient()->sendRequest('PATCH', $path, $data);

        /** @var Article $model */
        $model = $this->getModelFactory()->create(Article::class, $response);

        return $model;
    }
}
