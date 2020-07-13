<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Article;

use Yproximite\Api\Message\LocaleAwareMessageTrait;
use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Model\Article\ArticleTranslation;

/**
 * Class ArticleTranslationMessage
 */
class ArticleTranslationMessage implements MessageInterface
{
    use LocaleAwareMessageTrait;

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string|null
     */
    private $body;

    public static function createFromArticleTranslation(ArticleTranslation $translation): self
    {
        $message = new self();
        $message->setLocale($translation->getLocale());
        $message->setTitle($translation->getTitle());
        $message->setBody($translation->getBody());

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
    public function getBody()
    {
        return $this->body;
    }

    public function setBody(string $body = null)
    {
        $this->body = $body;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'title' => $this->getTitle(),
            'body'  => $this->getBody(),
        ];
    }
}
