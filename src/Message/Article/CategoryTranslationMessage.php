<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\LocaleAwareMessageTrait;
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

    /**
     * @param CategoryTranslation $translation
     *
     * @return self
     */
    public static function createFromCategoryTranslation(CategoryTranslation $translation): self
    {
        $message = new self();
        $message->setLocale($translation->getLocale());
        $message->setTitle($translation->getTitle());
        $message->setDescription($translation->getDescription());

        return $message;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array
    {
        return [
            'title'       => $this->getTitle(),
            'description' => $this->getDescription(),
        ];
    }
}
