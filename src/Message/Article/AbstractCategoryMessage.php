<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;
use Yproximite\Api\Util\Helper;

/**
 * Class AbstractCategoryMessage
 */
abstract class AbstractCategoryMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * @var int|null
     */
    private $parentRootId;

    /**
     * @var bool|null
     */
    private $enabled;

    /**
     * @var CategoryTranslationMessage[]
     */
    private $translations = [];

    /**
     * @return int|null
     */
    public function getParentRootId()
    {
        return $this->parentRootId;
    }

    public function setParentRootId(int $parentRootId = null)
    {
        $this->parentRootId = $parentRootId;
    }

    /**
     * @return bool|null
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled = null)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return CategoryTranslationMessage[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function addTranslation(CategoryTranslationMessage $translation)
    {
        $this->translations[] = $translation;
    }

    public function removeTranslation(CategoryTranslationMessage $translation)
    {
        array_splice($this->translations, array_search($translation, $this->translations), 1);
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'parentRootId' => $this->getParentRootId(),
            'enabled'      => $this->isEnabled(),
            'translations' => Helper::buildMessages($this->getTranslations(), 'locale'),
        ];
    }
}
