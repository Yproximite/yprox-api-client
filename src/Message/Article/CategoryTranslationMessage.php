<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\LocaleAwareMessageTrait;
use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Model\Article\CategoryTranslation;

/**
 * Class CategoryTranslationMessage
 */
class CategoryTranslationMessage implements MessageInterface
{
    use LocaleAwareMessageTrait;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string|null
     */
    private $description;

    public static function createFromCategoryTranslation(CategoryTranslation $translation): self
    {
        $message = new self();
        $message->setLocale($translation->getLocale());
        $message->setTitle($translation->getTitle());
        $message->setDescription($translation->getDescription());

        return $message;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description = null)
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'title'       => $this->getTitle(),
            'description' => $this->getDescription(),
        ];
    }
}
