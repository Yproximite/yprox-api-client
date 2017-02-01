<?php
declare(strict_types=1);

namespace Yproximite\Api\Message;

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

    /**
     * @param ArticleTranslation $translation
     *
     * @return self
     */
    public static function createFromArticleTranslation(ArticleTranslation $translation): self
    {
        $message = new ArticleTranslationMessage();
        $message->setLocale($translation->getLocale());
        $message->setTitle($translation->getTitle());
        $message->setBody($translation->getBody());

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
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param null|string $body
     */
    public function setBody(string $body = null)
    {
        $this->body = $body;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array
    {
        return [
            'title' => $this->title,
            'body'  => $this->body,
        ];
    }
}
