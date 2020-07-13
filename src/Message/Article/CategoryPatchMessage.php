<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Model\Article\Category;

/**
 * Class CategoryPatchMessage
 */
class CategoryPatchMessage extends AbstractCategoryMessage
{
    use IdentityAwareMessageTrait;

    public static function createFromCategory(Category $category): self
    {
        $message = new self();
        $message->setId($category->getId());
        $message->setEnabled($category->isEnabled());

        foreach ($category->getTranslations() as $translation) {
            $transMessage = CategoryTranslationMessage::createFromCategoryTranslation($translation);

            $message->addTranslation($transMessage);
        }

        return $message;
    }
}
