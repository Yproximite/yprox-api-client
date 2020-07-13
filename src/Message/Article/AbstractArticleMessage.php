<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;
use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Util\Helper;

/**
 * Class AbstractArticleMessage
 */
abstract class AbstractArticleMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * @var ArticleTranslationMessage[]
     */
    private $translations = [];

    /**
     * @var string|null
     */
    private $status;

    /**
     * @var int[]
     */
    private $categoryIds = [];

    /**
     * @var ArticleMediaMessage[]
     */
    private $medias = [];

    /**
     * @var int|null
     */
    private $mediaLimit;

    /**
     * @var bool|null
     */
    private $shareOnFacebook;

    /**
     * @return ArticleTranslationMessage[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function addTranslation(ArticleTranslationMessage $translation)
    {
        $this->translations[] = $translation;
    }

    public function removeTranslation(ArticleTranslationMessage $translation)
    {
        array_splice($this->translations, array_search($translation, $this->translations), 1);
    }

    /**
     * @see Article::getStatuses()
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(string $status = null)
    {
        $this->status = $status;
    }

    /**
     * @return \int[]
     */
    public function getCategoryIds(): array
    {
        return $this->categoryIds;
    }

    /**
     * @param \int[] $categoryIds
     */
    public function setCategoryIds(array $categoryIds)
    {
        $this->categoryIds = $categoryIds;
    }

    /**
     * @return ArticleMediaMessage[]
     */
    public function getMedias(): array
    {
        return $this->medias;
    }

    public function addMedia(ArticleMediaMessage $media)
    {
        $this->medias[] = $media;
    }

    public function removeMedia(ArticleMediaMessage $media)
    {
        array_splice($this->medias, array_search($media, $this->medias), 1);
    }

    /**
     * @return int|null
     */
    public function getMediaLimit()
    {
        return $this->mediaLimit;
    }

    public function setMediaLimit(int $mediaLimit = null)
    {
        $this->mediaLimit = $mediaLimit;
    }

    /**
     * @return bool|null
     */
    public function isShareOnFacebook()
    {
        return $this->shareOnFacebook;
    }

    public function setShareOnFacebook(bool $shareOnFacebook = null)
    {
        $this->shareOnFacebook = $shareOnFacebook;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'translations'    => Helper::buildMessages($this->getTranslations(), 'locale'),
            'status'          => $this->getStatus(),
            'categories'      => $this->getCategoryIds(),
            'articleMedias'   => Helper::buildMessages($this->getMedias()),
            'mediaLimit'      => $this->getMediaLimit(),
            'shareOnFacebook' => $this->isShareOnFacebook(),
        ];
    }
}
