<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Message\ArticlePostMessage;
use Yproximite\Api\Model\Article\Article;

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

        return new Article($response);
    }
}
