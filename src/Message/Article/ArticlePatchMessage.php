<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Model\Article\Category;
use Yproximite\Api\Message\IdentityAwareMessageTrait;

/**
 * Class ArticlePatchMessage
 */
class ArticlePatchMessage extends ArticleMessage
{
    use IdentityAwareMessageTrait;

    /**
     * @param Article $article
     *
     * @return self
     */
    public static function createFromArticle(Article $article): self
    {
        $message = new ArticlePatchMessage();
        $message->setId($article->getId());
        $message->setStatus($article->getStatus());
        $message->setMediaLimit($article->getMediaLimit());
        $message->setShareOnFacebook($article->isShareOnFacebook());

        $categoryIds = array_map(function(Category $category) {
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
