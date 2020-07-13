<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Model\Article\Category;

/**
 * Class ArticlePatchMessage
 */
class ArticlePatchMessage extends AbstractArticleMessage
{
    use IdentityAwareMessageTrait;

    public static function createFromArticle(Article $article): self
    {
        $message = new self();
        $message->setId($article->getId());
        $message->setStatus($article->getStatus());
        $message->setMediaLimit($article->getMediaLimit());
        $message->setShareOnFacebook($article->isShareOnFacebook());

        $categoryIds = array_map(function (Category $category) {
            return $category->getId();
        }, $article->getCategories());

        $message->setCategoryIds($categoryIds);

        foreach ($article->getTranslations() as $translation) {
            $translationMessage = ArticleTranslationMessage::createFromArticleTranslation($translation);

            $message->addTranslation($translationMessage);
        }

        foreach ($article->getMedias() as $media) {
            $mediaMessage = ArticleMediaMessage::createFromArticleMedia($media);

            $message->addMedia($mediaMessage);
        }

        return $message;
    }
}
