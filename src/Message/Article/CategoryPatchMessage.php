<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Model\Article\Category;
use Yproximite\Api\Message\IdentityAwareMessageTrait;

/**
 * Class CategoryPatchMessage
 */
class CategoryPatchMessage extends AbstractCategoryMessage
{
    use IdentityAwareMessageTrait;

    /**
     * @param Category $category
     *
     * @return self
     */
    public static function createFromCategory(Category $category): self
    {
        $message = new self();
        $message->setEnabled($category->isEnabled());

        foreach ($category->getTranslations() as $translation) {
            $transMessage = CategoryTranslationMessage::createFromCategoryTranslation($translation);

            $message->addTranslation($transMessage);
        }

        return $message;
    }
}
