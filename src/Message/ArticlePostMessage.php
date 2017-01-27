<?php
declare(strict_types=1);

namespace Yproximite\Api\Message;

use Yproximite\Api\Util\Helper;
use Yproximite\Api\Model\Article\Article;

/**
 * Class ArticlePostMessage
 */
class ArticlePostMessage implements MessageInterface
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
     * @var bool
     */
    private $shareOnFacebook = false;

    /**
     * @return ArticleTranslationMessage[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * @param ArticleTranslationMessage $translation
     */
    public function addTranslation(ArticleTranslationMessage $translation)
    {
        $this->translations[] = $translation;
    }

    /**
     * @see Article::getStatuses()
     *
     * @return null|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null|string $status
     */
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

    /**
     * @param ArticleMediaMessage[] $medias
     */
    public function setMedias(array $medias)
    {
        $this->medias = $medias;
    }

    /**
     * @return int|null
     */
    public function getMediaLimit()
    {
        return $this->mediaLimit;
    }

    /**
     * @param int|null $mediaLimit
     */
    public function setMediaLimit(int $mediaLimit = null)
    {
        $this->mediaLimit = $mediaLimit;
    }

    /**
     * @return bool
     */
    public function isShareOnFacebook(): bool
    {
        return $this->shareOnFacebook;
    }

    /**
     * @param bool $shareOnFacebook
     */
    public function setShareOnFacebook(bool $shareOnFacebook)
    {
        $this->shareOnFacebook = $shareOnFacebook;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array
    {
        return [
            'translations'    => Helper::buildMessages($this->translations),
            'status'          => $this->status,
            'categories'      => $this->categoryIds,
            'articleMedias'   => Helper::buildMessages($this->medias),
            'mediaLimit'      => $this->mediaLimit,
            'shareOnFacebook' => $this->shareOnFacebook,
        ];
    }
}
