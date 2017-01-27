<?php
declare(strict_types=1);

namespace Yproximite\Api\Message;

/**
 * Class ArticleTranslationMessage
 */
class ArticleTranslationMessage implements MessageInterface
{
    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string|null
     */
    private $body;

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
